<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    // Hàm xử lý khi user bấm nút "Gửi mã OTP"
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.exists' => 'Email này không tồn tại trong hệ thống.'
        ]);

        $otp = rand(100000, 999999);
        $email = $request->email;

        // Lưu hoặc cập nhật OTP vào bảng password_reset_tokens
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'token' => \Str::random(60), // Vẫn giữ token theo chuẩn Laravel
                'otp' => $otp,
                'created_at' => Carbon::now()
            ]
        );

        try {
            Mail::to($email)->send(new OtpMail($otp));
            
            // Lưu email vào session để dùng ở trang nhập OTP
            session(['reset_email' => $email]);

            return redirect()->route('password.otp.view')
                             ->with('status', 'Mã OTP đã được gửi đến email của bạn.');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Lỗi gửi mail: ' . $e->getMessage()]);
        }
    }

    // Hàm hiển thị trang nhập 6 ô OTP (Giai đoạn 2)
    public function showOtpForm()
    {
        if (!session('reset_email')) {
            return redirect()->route('password.request');
        }
        return view('auth.verify-otp'); // Chúng ta sẽ tạo file này tiếp theo
    }
    public function resetPassword(Request $request)
{
        // 1. Validate dữ liệu đầu vào
        $request->validate([
            'otp' => 'required|digits:6',
            'password' => 'required|min:6|confirmed',
        ], [
            'otp.digits' => 'Mã OTP phải có đủ 6 chữ số.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'password.min' => 'Mật khẩu phải ít nhất 6 ký tự.'
        ]);

        $email = session('reset_email');

        // 2. Kiểm tra mã OTP trong Database
        $resetData = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->where('otp', $request->otp)
            ->first();

        // Kiểm tra nếu mã sai hoặc quá hạn (ví dụ quá 10 phút)
        if (!$resetData || Carbon::parse($resetData->created_at)->addMinutes(10)->isPast()) {
            return back()->withErrors(['otp' => 'Mã OTP không chính xác hoặc đã hết hạn.']);
        }

        // 3. Cập nhật mật khẩu mới cho User
        $user = User::where('email', $email)->first();
        if ($user) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);

            // 4. Xóa OTP sau khi dùng xong và xóa session
            DB::table('password_reset_tokens')->where('email', $email)->delete();
            session()->forget('reset_email');

            return redirect()->route('login')->with('status', 'Đổi mật khẩu thành công! Vui lòng đăng nhập.');
        }

        return back()->withErrors(['email' => 'Có lỗi xảy ra, vui lòng thử lại.']);
    }
}