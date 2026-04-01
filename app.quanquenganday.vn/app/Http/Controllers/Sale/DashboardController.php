<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Shop;
use App\Models\Order;
use App\Models\SystemNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Traits\HasRoles;

class DashboardController extends Controller
{
    
    public function index()
    {
        $user = Auth::user();
        $currentMonth = now()->month;
    $currentYear = now()->year;

        // 1. Lấy tổng số quán đã mời (Dữ liệu cho ô "128 quán")
        $countShops = Shop::where('sale_id', $user->id)->count();

        // 2. Lấy tổng số sale F1 (Dữ liệu cho ô "24 sale")
        $countSalesF1 = User::where('parent_id', $user->id)->count();

        // 3. Số đơn POS đã thanh toán trong tháng này (Dữ liệu cho ô "1 POS tháng này")
        $posThisMonth = Order::where('sale_id', $user->id)
            ->where('status', 'paid')
            ->whereMonth('created_at', now()->month)
            ->count();

        // 4. Số lượng quán đang hoạt động (Dữ liệu cho ô "36 Quán active")
        $activeShops = Shop::where('sale_id', $user->id)
            ->where('status', 'active')
            ->count();

            // Tính tổng hoa hồng + kpi đã được duyệt (paid) trong tháng
    // 1. Tính số dư cá nhân của Sale đang đăng nhập (Lấy trực tiếp từ DB cho chính xác)
    $monthlyBalance = \App\Models\Order::where('sale_id', $user->id)
        ->where('status', 'paid')
        ->whereMonth('created_at', $currentMonth)
        ->whereYear('created_at', $currentYear)
        ->selectRaw('SUM(commission + kpi_bonus) as total')
        ->first()->total ?? 0;

    // 2. Lấy danh sách Top 5 Thu nhập (Dùng Cache để nhẹ server)
//     $topSales = \Illuminate\Support\Facades\Cache::remember('top_income_monthly', 3600, function () use ($currentMonth, $currentYear) {
//     return \App\Models\User::where('role', 'sale')
//         // Tạo một cột ảo tên là total_income bằng câu lệnh SQL SUBQUERY
//         ->addSelect(['total_income' => \App\Models\Order::selectRaw('SUM(commission + kpi_bonus)')
//             ->whereColumn('sale_id', 'users.id')
//             ->where('status', 'paid')
//             ->whereMonth('created_at', $currentMonth)
//             ->whereYear('created_at', $currentYear)
//         ])
//         // Bây giờ bạn có thể orderBy thoải mái bằng cái tên total_income
//         ->orderBy('total_income', 'desc')
//         ->take(5)
//         ->get();
// });
$topSales = User::where('role', 'sale')
    ->addSelect(['total_income' => Order::selectRaw('IFNULL(SUM(commission + kpi_bonus), 0)')
        ->whereColumn('sale_id', 'users.id')
        ->where('status', 'paid')
        ->whereMonth('created_at', $currentMonth)
        ->whereYear('created_at', $currentYear)
    ])
    ->orderBy('total_income', 'desc')
    ->take(5)
    ->get();
        // 6. Kiểm tra thông báo chưa đọc (Để hiện chấm đỏ trên icon Chuông)
        $hasUnreadNoti = SystemNotification::where('user_id', $user->id)
            ->where('is_read', false)
            ->exists();

        return view('sale.dashboard', compact(
            'user', 
            'countShops', 
            'countSalesF1', 
            'posThisMonth', 
            'activeShops', 
            'topSales',
            'hasUnreadNoti',
            'monthlyBalance'
        ));
    }
}