<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerificationController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // 1. Hiển thị trang danh sách xác minh (Email, SĐT...)
    public function index()
    {
        return view('profile.verify'); 
    }

    // 2. Xử lý gửi lại link xác minh vào Email
    public function send(Request $request)
    {
        // Kiểm tra nếu user đã xác minh rồi thì chuyển hướng luôn
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('profile.show');
        }

        // Gửi email xác minh (Laravel tự động xử lý nội dung mail)
        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'Một liên kết xác minh mới đã được gửi đến địa chỉ email của bạn.');
    }
}