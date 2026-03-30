<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AffiliateController;

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



