<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Sale\DashboardController as SaleDashboard;
use App\Http\Controllers\Sale\OrderController;
use App\Http\Controllers\Sale\ShopController;
use App\Http\Controllers\Admin\SettingController;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\BankAccountController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\OTPController;
use App\Http\Controllers\CCCDController;

use App\Http\Controllers\Admin\UserLocationController;
use App\Http\Controllers\Admin\NotificationController;

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



Route::middleware(['auth'])->prefix('sale')->name('sale.')->group(function () {
    Route::get('/dashboard', [SaleDashboard::class, 'index'])->name('dashboard');
});


// Route xử lý gửi mã
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendOtp'])->name('password.email');

// Route hiển thị trang nhập OTP
Route::get('/verify-otp', [ForgotPasswordController::class, 'showOtpForm'])->name('password.otp.view');

// Route xử lý khi user nhấn "Xác nhận đổi mật khẩu"
Route::post('/reset-password-otp', [ForgotPasswordController::class, 'resetPassword'])->name('password.update.otp');

Route::get('/register-shop/success', function () {
    return view('auth.register-shop-success');
})->name('register.shop.success');


// Nhóm Route cho SALE
Route::middleware(['auth', 'role:sale'])->prefix('sale')->name('sale.')->group(function () {
    // Trang chủ Sale
    Route::get('/dashboard', [SaleDashboard::class, 'index'])->name('dashboard');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    
    // Quản lý đơn hàng (Resource sẽ tạo ra sale.orders.create, sale.orders.store...)
    // Nếu đã ở trong Group prefix('sale')
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');

});


// Nhóm các Route dành riêng cho ADMIN
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Các route settings nằm trong đây
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
    
    // Bạn có thể thêm các route quản lý khác của admin ở đây
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

     Route::post('/settings/store', [SettingController::class, 'store'])->name('settings.store');

     Route::get('/assign-wards', [UserLocationController::class, 'index'])->name('assign.index');
    Route::post('/assign-wards', [UserLocationController::class, 'store'])->name('assign.store');

    
    
    // Trang hiển thị Form tạo thông báo
    Route::get('/notifications/create', [NotificationController::class, 'create'])->name('notifications.create');    
    // Xử lý lưu thông báo vào DB
    Route::post('/notifications/store', [NotificationController::class, 'store'])->name('notifications.store');

});

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::post('/notifications/{id}/read', [NotificationController::class, 'markRead']);
//xoá cached
use Illuminate\Support\Facades\Artisan;


Route::get('/clear-all-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    return "Đã dọn dẹp sạch sẽ cache hệ thống!";
});


Route::middleware(['auth'])->group(function () {
    // Route hiển thị Form (GET)
    Route::get('/profile/change-password', [ProfileController::class, 'editPassword'])
         ->name('password.change'); 
    // Route xử lý Lưu mật khẩu (POST/PUT)
    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])
         ->name('user.password.update');

    // 1. Route để hiển thị trang nhập thông tin (GET)
    Route::get('/bank-account', [BankAccountController::class, 'index'])->name('bank.index');
    // 2. Route để xử lý lưu dữ liệu khi nhấn nút (POST)
    Route::post('/bank-account', [BankAccountController::class, 'store'])->name('bank.store');

    Route::get('/verify-account', [VerificationController::class, 'index'])->name('verify.index');
    // Route xử lý gửi lại Email
    Route::post('/email/verification-notification', [VerificationController::class, 'send'])
        ->middleware('throttle:6,1') // Giới hạn 1 phút chỉ được nhấn 6 lần tránh spam
        ->name('verification.send');

    // Route xử lý khi User click vào link trong Email gửi về
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('verify.index')->with('status', 'Email của bạn đã được xác minh thành công!');
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/send-otp', [OTPController::class, 'sendOtp'])->name('otp.send');
    Route::post('/verify-otp', [OTPController::class, 'verifyOtp'])->name('otp.verify');

    Route::post('/verify-cccd/upload', [CCCDController::class, 'upload'])->name('cccd.upload');
    Route::get('/invited-shops', [ShopController::class, 'index'])->name('sale.shops.index');
    // Route xem chi tiết quán
    Route::get('/invited-shops/{id}', [ShopController::class, 'show'])->name('sale.shops.show');
});


Route::get('/tools', function () {
    return view('tools.index');
})->name('tools.index');


use App\Http\Controllers\LocationController;

Route::get('/api/search-wards', [LocationController::class, 'searchWards'])->name('api.search.wards');