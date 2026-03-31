<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\Auth\ForgotPasswordController;

use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/register-sale', [AffiliateController::class, 'showSaleForm'])->name('register.sale');
Route::post('/register-sale', [AffiliateController::class, 'storeSale'])->name('register.sale.store');
Route::get('/register-shop', [AffiliateController::class, 'showShopForm'])->name('register.shop');
Route::post('/store-shop', [AffiliateController::class, 'storeShop'])->name('shop.store');


// Route xử lý gửi mã
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendOtp'])->name('password.email');

// Route hiển thị trang nhập OTP
Route::get('/verify-otp', [ForgotPasswordController::class, 'showOtpForm'])->name('password.otp.view');

// Route xử lý khi user nhấn "Xác nhận đổi mật khẩu"
Route::post('/reset-password-otp', [ForgotPasswordController::class, 'resetPassword'])->name('password.update.otp');

Route::get('/register-shop/success', function () {
    return view('auth.register-shop-success');
})->name('register.shop.success');