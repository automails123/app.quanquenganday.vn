<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    
    public function index(Request $request)
    {
        $user = Auth::user();
        
        $query = Shop::query();

        // Phân quyền: Admin thấy hết, Sale thấy quán của mình
        if ($user->role !== 'admin') {
            $query->where('sale_id', $user->id);
        }

        // Nếu có tìm kiếm (Search)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }
    $totalCount = $query->count();
        $shops = $query->latest()->paginate(10);

        return view('sale.shops.index', compact('shops', 'totalCount'));
    }

    /**
     * Xem chi tiết một quán (Nếu cần)
     */
    
    public function show($id)
    {
        // Tìm quán theo ID và đảm bảo quán đó thuộc về Sale đang đăng nhập
        $shop = Shop::where('sale_id', auth()->id())->findOrFail($id);

        return view('sale.shops.show', compact('shop'));
        
    }
    public function update(Request $request, $id)
    {
        $shop = Shop::where('sale_id', auth()->id())->findOrFail($id);
        $request->validate([
            'name' => 'required|max:255',
            'ward' => 'nullable', // Bỏ exists nếu bạn lo lắng về việc khớp code, hoặc giữ nếu bảng wards chuẩn
            'owner_name' => 'nullable|max:255',
            'phone' => 'nullable|digits_between:10,11',
            'note' => 'nullable',
            // Lưu ý: GPKD có thể là PDF nên cần mimes:pdf
            'gpkd_image' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048', 
            'cccd_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            // Thông báo lỗi dung lượng (max)
            'gpkd_image.max' => 'File Giấy phép kinh doanh không được vượt quá 2MB.',
            'cccd_image.max' => 'Ảnh CCCD không được vượt quá 2MB.',
            
            // Thông báo lỗi định dạng (mimes)
            'gpkd_image.mimes' => 'GPKD phải là định dạng ảnh (jpg, png) hoặc file PDF.',
            'cccd_image.mimes' => 'CCCD phải là định dạng ảnh (jpg, png).',
            
            // Các lỗi khác nếu cần
            'name.required' => 'Vui lòng không để trống tên quán.',
            'phone.digits_between' => 'Số điện thoại phải từ 10 đến 11 số.',
        ]);

        $shop->fill($request->only(['name', 'owner_name', 'phone', 'note']));
if ($request->filled('status')) {
    $shop->status = $request->status;
}
        if ($request->filled('ward')) {
            $shop->ward = $request->ward;
            $wardInfo = \App\Models\Ward::where('code', $request->ward)->first();
            if ($wardInfo) {
                // Giả sử bảng wards của bạn có cột province_code hoặc city_id
                // Duyqt kiểm tra lại tên cột này trong bảng wards nhé
                $shop->city = $wardInfo->province_code; 
            }    
        }
        if ($request->filled('city')) {
            $shop->city = $request->city;
        }  

   

       // 3. Xử lý lưu File GPKD (Hỗ trợ cả ảnh và PDF)
        if ($request->hasFile('gpkd_image')) {
            // Xóa file cũ nếu tồn tại
            if ($shop->gpkd_path) {
                Storage::disk('public')->delete($shop->gpkd_path);
            }
            // Lưu file vào thư mục public/shops/gpkd
            $shop->gpkd_path = $request->file('gpkd_image')->store('shops/gpkd', 'public');
        }

        // 4. Xử lý lưu File CCCD
        if ($request->hasFile('cccd_image')) {
            // Xóa ảnh cũ nếu tồn tại
            if ($shop->cccd_path) {
                Storage::disk('public')->delete($shop->cccd_path);
            }
            // Lưu ảnh vào thư mục public/shops/cccd
            $shop->cccd_path = $request->file('cccd_image')->store('shops/cccd', 'public');
        }

        $shop->save();

        return back()->with('success', 'Cập nhật hồ sơ thành công!');
    }
}
