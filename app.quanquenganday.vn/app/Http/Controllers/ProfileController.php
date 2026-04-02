<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
   public function editPassword()
    {
        // Trỏ đúng vào file bạn đã tạo ở resources/views/profile/change-password.blade.php
        return view('profile.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        $user = $request->user();
        $user->update([
            'password' => Hash::make($request->password),
        ]);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // 5. Chuyển hướng về trang Login kèm thông báo thành công
        return redirect()->route('login')->with('status', 'Mật khẩu đã thay đổi. Vui lòng đăng nhập lại!');
    }

}
