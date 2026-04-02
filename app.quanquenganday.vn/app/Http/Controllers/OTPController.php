<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;


class OTPController extends Controller
{
    /**
     * Gửi mã OTP đến Email của người dùng
     */
    public function sendOtp(Request $request)
    {
        $user = auth()->user();
        
        // Tạo mã ngẫu nhiên 6 số
        $otp = rand(100000, 999999);
        
        // Lưu vào Database (Cần chạy migration thêm cột otp và otp_expires_at trước)
        $user->otp = $otp;
        $user->email_verified_at = now();
        $user->otp_expires_at = now()->addMinutes(5);
        // $user->otp = null;
        $user->save();

        // Logic gửi Mail (Bạn cần cấu hình SMTP trong .env)
        Mail::to($user->email)->send(new \App\Mail\SendOtpMail($otp));

        return response()->json([
            'success' => true,
            'message' => 'Mã OTP đã được gửi đến email của bạn!'
        ]);
    }

    /**
     * Kiểm tra mã OTP người dùng nhập vào
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6'
        ]);

        $user = auth()->user();
        if ($user->otp != $request->otp) {
                return response()->json(['success' => false, 'message' => 'Mã OTP bạn nhập không khớp!'], 422);
            }

            if (now()->isAfter($user->otp_expires_at)) {
                return response()->json(['success' => false, 'message' => 'Mã OTP đã hết hạn (quá 5 phút)!'], 422);
            }
        // Kiểm tra mã khớp và chưa hết hạn
        if ($user->otp == $request->otp && Carbon::now()->isBefore($user->otp_expires_at)) {
            
            // Đánh dấu đã xác minh
            // $user->update([
            //     'email_verified_at' => now(),
            //     'otp' => null, // Xóa mã sau khi dùng xong
            //     'otp_expires_at' => null
            // ]);
            $user->otp = null;
            $user->email_verified_at = now();
            $user->otp_expires_at = null;
            $user->save();

            return response()->json([
                'success' => true, 
                'message' => 'Xác minh thành công!',
                'redirect' => route('verify.index') 
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Mã OTP không đúng hoặc đã hết hạn.'], 422);
    }
}