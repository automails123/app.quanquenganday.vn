<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\Auth\ForgotPasswordController;


use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Sale\DashboardController as SaleDashboard;
use App\Http\Controllers\Sale\OrderController;
use App\Http\Controllers\Admin\SettingController;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\ProfileController;

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


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    // Thêm các route duyệt đơn, duyệt quán ở đây...
});

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

});

//xoá cached
use Illuminate\Support\Facades\Artisan;

Route::get('/clear-all-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    return "Đã dọn dẹp sạch sẽ cache hệ thống!";
});


// Route::post('/user/update-password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])
//      ->name('user.password.update');


Route::middleware(['auth'])->group(function () {
    // Route hiển thị Form (GET)
    Route::get('/profile/change-password', [ProfileController::class, 'editPassword'])
         ->name('password.change'); // Tên này phải khớp với trong Blade

    // Route xử lý Lưu mật khẩu (POST/PUT)
    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])
         ->name('user.password.update');
});