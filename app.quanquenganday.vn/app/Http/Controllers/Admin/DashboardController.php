<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Shop;
use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Tổng số Sale trong hệ thống
        $totalSales = User::where('role', 'sale')->count();

        // 2. Tổng số Quán đã đăng ký
        $totalShops = Shop::count();

        // 3. Số đơn hàng POS đang chờ duyệt (Cần xử lý gấp)
        $pendingOrdersCount = Order::where('status', 'pending')->count();

        // 4. Tổng hoa hồng đã chi trả (Các đơn đã duyệt)
        $totalPaidCommission = Order::where('status', 'paid')->sum('commission');

        // 5. Danh sách 5 đơn hàng mới nhất cần duyệt
        $latestOrders = Order::with(['shop', 'sale'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // 6. Danh sách 5 Quán mới đăng ký chờ duyệt hồ sơ
        $latestShops = Shop::with('sale')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        
        $totalUser = User::count();
        $activeUser = User::where('status', 'active')->count();

        // // 2. Thống kê Quán
        $totalShop = Shop::count();
        $activeShop = Shop::where('status', 'paid')->count();

        // // 3. Đơn chờ duyệt (Các quán có status là pending)
        $pendingShops = Order::where('status', 'pending')->count();

        // 4. Tổng hoa hồng (Giả sử tính tổng cột pos_price hoặc từ bảng commissions)
        // Ở đây mình lấy ví dụ tổng tiền POS của các quán đã active chia % hoa hồng
        $totalCommission = Shop::where('status', 'paid')->sum('pos_price'); 
        // Giả sử quỹ hoa hồng là 10% tổng doanh thu POS
        $commissionFund = ($totalCommission * 10) / 100;

        return view('admin.dashboard', compact(
            'totalUser', 
            'activeUser', 
            'totalShop', 
            'activeShop', 
            'pendingShops', 
            'commissionFund'
        ));
            //tạm thời hiện setting để cấu hình 
        $settings = Setting::all()->pluck('value', 'key')->toArray();    

        // return view('admin.settings', compact('settings'));
        //<a href="{{ route('admin.settings.index') }}">Cấu hình hệ thống</a>
    }
}