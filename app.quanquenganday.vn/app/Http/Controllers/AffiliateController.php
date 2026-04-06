<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\NotificationController;

class AffiliateController extends Controller
{
    // Hiển thị Form Đăng ký Sale
    public function showSaleForm(Request $request) {
        // $ref = $request->query('ref');
        $ref = $request->query('ref', '');
        return view('auth.register-sale', compact('ref'));
    }

    // Hiển thị Form Đăng ký Quán
    public function showShopForm(Request $request) {
        // $ref = $request->query('ref');
        $ref = $request->query('ref', '');
        return view('auth.register-shop', compact('ref'));
    }
    // Lưu dữ liệu Quán
    public function storeShop(Request $request) {   
       $request->validate([
        'ref_code' => 'required|exists:users,affiliate_id',
            'shop_name'    => 'required|string|max:255',
            'owner_name'   => 'required|string|max:255',
            'phone'        => 'required|string|min:10|max:11',
            'ref_code'     => 'required|exists:users,affiliate_id', // Kiểm tra mã sale có thật không
            'gpkd_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:65536',
            'cccd_file' => 'nullable|file|mimes:jpg,jpeg,png|max:65536',
        ], [
            'ref_code.required' => 'Bạn phải nhập mã giới thiệu để tiếp tục.',
            'ref_code.exists'   => 'Mã giới thiệu này không tồn tại trên hệ thống.',
            'shop_name.required' => 'Vui lòng nhập tên quán.',
            'phone.min'          => 'Số điện thoại phải từ 10 số.',
            'phone.max'          => 'Số điện thoại không được quá 11 chữ số.',
            'gpkd_file.max' => 'File quá lớn! Vui lòng chọn file dưới 64MB.',
            'cccd_file.max' => 'File quá lớn! Vui lòng chọn file dưới 64MB.',
        ]);
        $sale = User::where('affiliate_id', $request->ref_code)->first();
        // if (!$sale) {
        //     return back()->withErrors(['ref_code' => 'Mã giới thiệu không tồn tại.']);
        // }
        
        $gpkdPath = null;
        if ($request->hasFile('gpkd_file')) {
            // Cách lưu tường minh
            $file = $request->file('gpkd_file');
            $fileName = time() . '_gpkd_' . $file->getClientOriginalName();
            $gpkdPath = $file->storeAs('shops/legal', $fileName, 'public');
        }

        $cccdPath = null;
        if ($request->hasFile('cccd_file')) {
            // Cách lưu tường minh
            $file = $request->file('cccd_file');
            $fileName = time() . '_cccd_' . $file->getClientOriginalName();
            $cccdPath = $file->storeAs('shops/cccd', $fileName, 'public');
        }
        $cccdPath = $request->hasFile('cccd_file') ? $request->file('cccd_file')->store('shops/cccd', 'public') : null;
        

        // 4. Lưu vào bảng shops
        Shop::create([
            'name'           => $request->shop_name,
            'owner_name'     => $request->owner_name,
            'phone'          => $request->phone,
            'address_number' => $request->address_number,
            'street'         => $request->street,
            'ward'           => $request->ward,
            'city'           => $request->city,
            'tax_code'       => $request->tax_code,
            'gpkd_path'      => $gpkdPath,
            'cccd_path'      => $cccdPath,
            'sale_id'        => $sale->id,
            'pos_price'      => $request->pos_price ?? 1800000,
            'status'         => 'pending', // Chờ duyệt
        ]);
        return redirect()->route('register.shop.success')->with('sale_phone', $sale->phone);

            // 5. Trả về thông báo thành công
        // return back()->with('success', 'Gửi thông tin đăng ký thành công! Chúng tôi sẽ liên hệ lại sớm.');
    }

    public function storeSale(Request $request) {
        $rules = [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'phone'    => 'required|string|min:10|max:11',
            'password' => 'required|string|min:6|confirmed',
            'ref_code' => 'required|exists:users,affiliate_id',
        ];

        $messages = [
            // Lỗi cho Phone
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.min'      => 'Số điện thoại phải có ít nhất 10 chữ số.',
            'phone.max'      => 'Số điện thoại không được quá 11 chữ số.',
            
            // Lỗi cho Password
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min'      => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed'=> 'Xác nhận mật khẩu không khớp.',

            // Lỗi cho các trường khác
            'name.required'  => 'Vui lòng nhập họ và tên.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email'    => 'Địa chỉ email không đúng định dạng.',
            'email.unique'   => 'Email này đã được đăng ký rồi.',
            'ref_code.required' => 'Bạn phải nhập mã giới thiệu để tiếp tục.',
            'ref_code.exists'   => 'Mã giới thiệu này không tồn tại trên hệ thống.',
        ];

        $request->validate($rules, $messages);
        // 2. Tìm người giới thiệu (Parent)
        $parent = User::where('affiliate_id', $request->ref_code)->first();
        // 3. Xác định Level dựa trên Role của người giới thiệu
// Nếu Parent là admin -> Level 1. Nếu không -> Level của Parent + 1
    $newUserLevel = ($parent->role === 'admin') ? 1 : ($parent->level + 1);
        
        // 3. Tạo tài khoản Sale mới
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'parent_id' => $parent->id,
            'level' => $newUserLevel,
            'role' => 'sale',
            'affiliate_id' => 'SALE' . strtoupper(Str::random(6)),
        ]);

        if (isset($parent) && $parent->id) {
            NotificationController::sendSystemNotification(
                $parent->id, // Gửi đích danh cho người giới thiệu
                'Có sale mới', 
                '' . $user->name . ' đăng ký từ link của bạn'
            );
        }
                // TỰ ĐỘNG GỬI THÔNG BÁO
            NotificationController::sendSystemNotification(
                1, // Gửi đích danh cho Admin ID = 1 (Ví dụ vậy)
                'Có sale mới',
                'Sale ' . $user->name . ' vừa đăng ký dưới mã của ' . $parent->name,
                'new_sale'
            );

        // 4. Đăng nhập ngay và chuyển hướng
        Auth::login($user);
        return redirect()->route('sale.dashboard');
    }


}
