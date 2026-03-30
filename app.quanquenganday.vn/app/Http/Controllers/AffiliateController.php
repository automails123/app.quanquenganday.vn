<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AffiliateController extends Controller
{
    // Hiển thị Form Đăng ký Sale
    public function showSaleForm(Request $request) {
        $ref = $request->query('ref');
        return view('auth.register-sale', compact('ref'));
    }

    // Hiển thị Form Đăng ký Quán
    public function showShopForm(Request $request) {
        $ref = $request->query('ref');
        return view('auth.register-shop', compact('ref'));
    }
    // Lưu dữ liệu Quán
    public function storeShop(Request $request) {
        $sale = User::where('affiliate_id', $request->ref_code)->first();
        
        Shop::create([
            'name' => $request->shop_name,
            'owner_name' => $request->owner_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'type' => 'cafe', // Mặc định hoặc lấy từ form
            'sale_id' => $sale ? $sale->id : null,
        ]);

        return back()->with('success', 'Đăng ký quán thành công!');
    }

    public function storeSale(Request $request) {
    // 1. Kiểm tra dữ liệu đầu vào
    // $request->validate([
    //     'name' => ['required', 'string', 'max:255'],
    //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //     'phone'    => ['required', 'string', 'min:10', 'max:11', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
    //     // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //     'password' => ['required', 'min:6', 'confirmed'],
    //     'ref_code' => ['required', 'exists:users,affiliate_id'],
    // ]);
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
        'ref_code.required' => 'Thiếu mã giới thiệu.',
        'ref_code.exists'   => 'Mã giới thiệu không tồn tại trên hệ thống.',
    ];

    $request->validate($rules, $messages);
    // 2. Tìm người giới thiệu (Parent)
    $parent = User::where('affiliate_id', $request->ref_code)->first();
    
    // 3. Tạo tài khoản Sale mới
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => Hash::make($request->password),
        'parent_id' => $parent->id,
        'level' => $parent->level + 1,
        'role' => 'sale',
    ]);

    // 4. Đăng nhập ngay và chuyển hướng
    Auth::login($user);
    return redirect('/dashboard');
}


}
