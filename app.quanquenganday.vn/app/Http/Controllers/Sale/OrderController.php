<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Shop;
use App\Models\SystemNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Hiển thị danh sách đơn hàng của riêng Sale đó
     */
    public function index()
    {
        $orders = Order::where('sale_id', auth()->id())
            ->with('shop')
            ->orderBy('created_at', 'desc')
            ->get();

        // Thống kê nhanh cho màn hình "Quản lý đơn hàng"
        $stats = [
            'total_orders' => $orders->count(),
            'pending_count' => $orders->where('status', 'pending')->count(),
            'paid_count' => $orders->where('status', 'paid')->count(),
            'total_commission_pending' => $orders->where('status', 'pending')->sum('commission'),
        ];

        return view('sale.orders.index', compact('orders', 'stats'));
    }

    /**
     * Hiển thị form tạo đơn POS (Màn hình dấu + trung tâm)
     */
    public function create()
    {
        $defaultPrice = get_pos_setting('default_price', 1800000);

        $shops = Shop::where('sale_id', auth()->id())->get();

        // Đếm số đơn đã lên trong tháng này (để tính mốc KPI tiếp theo)
    $currentMonthOrders = Order::where('sale_id', auth()->id())
        ->whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->count();

        return view('sale.orders.create', compact('defaultPrice', 'shops', 'currentMonthOrders'));

    }

    /**
     * Lưu đơn hàng mới vào hệ thống
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'shop_id' => 'required|exists:shops,id',
            'amount' => 'required|numeric|min:0',
        ], [
            'shop_id.required' => 'Vui lòng chọn quán để lên đơn.',
            'amount.min' => 'Số tiền đơn hàng không hợp lệ.'
        ]);

        // Kiểm tra xem quán này có đúng là của Sale này không để tránh hack dữ liệu
        $shop = Shop::where('id', $request->shop_id)
            ->where('sale_id', auth()->id())
            ->firstOrFail();

            // dd($request->all());

        // Logic tính hoa hồng (Ví dụ: 15% theo chính sách POS)
        $commissionRate = 0.15; 
        $commission = $request->amount * $commissionRate;
        // 2. Tính Thưởng KPI dự kiến dựa trên số đơn TRONG THÁNG NÀY
        // Lấy số đơn đã có + 1 (đơn hiện tại)
        $orderCount = Order::where('sale_id', auth()->id())
            ->whereMonth('created_at', now()->month)
            ->count() + 1;

        $kpiBonus = 0;
        if ($orderCount == 2) {
            $kpiBonus = 100000; // Đạt mốc 2 đơn
        } elseif ($orderCount == 3) {
            $kpiBonus = 200000; // Cộng thêm 200k (để tổng là 300k)
        }

        DB::beginTransaction();
        try {
            $order = Order::create([
                'order_code' => 'DH-POS-' . strtoupper(Str::random(6)),
                'shop_id' => $request->shop_id,
                'sale_id' => auth()->id(),
                'amount' => $request->amount,
                'commission' => $commission, // Lưu 270.000đ
                'kpi_bonus' => $kpiBonus,   // Lưu thưởng mốc
                'status' => 'pending', // Chờ Admin duyệt
            ]);
            SystemNotification::create([
                'user_id' => auth()->id(),
                'title' => 'Lên đơn thành công',
                'content' => 'Đơn hàng ' . $order->order_code . ' đã được gửi. Vui lòng chờ Admin phê duyệt.',
                'type' => 'order_created', // Để hiển thị icon đen/trắng theo loại
                'is_read' => false
            ]);

            // Gửi thông báo cho hệ thống Admin
            // Lưu ý: Thông báo này để Admin biết có đơn mới cần xử lý
            
            DB::commit();
            return redirect()->route('sale.dashboard')->with('success', 'Đơn hàng đã được khởi tạo thành công!');
            // return redirect()->route('sale.orders.index')
            //     ->with('success', 'Tạo đơn hàng thành công! Vui lòng chờ Admin phê duyệt.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    /**
     * Xem chi tiết một đơn hàng
     */
    public function show($id)
    {
        $order = Order::where('sale_id', auth()->id())
            ->with('shop')
            ->findOrFail($id);

        return view('sale.orders.show', compact('order'));
    }
}