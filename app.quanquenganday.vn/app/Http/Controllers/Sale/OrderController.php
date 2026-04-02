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
    public function index(Request $request, $status = null)
    {
        $defaultPrice = get_pos_setting('default_price', 1800000);
        $user = auth()->user();
        $userId = auth()->id();
        $currentMonth = now()->month;
        $currentYear = now()->year;

        // 1. Lấy danh sách ID của bản thân và tất cả cấp dưới (đệ quy)
        // method getDescendantsIds() trong User Model, 
        $allSaleIds = $user->getAllSubordinateIds();

        // Tổng số đơn
        $totalOrders = Order::where('sale_id', $userId)->whereMonth('created_at', $currentMonth)->count();
        
        // Đơn đang xử lý
        $pendingOrders = Order::where('sale_id', $userId)->where('status', 'pending')->count();
        
        // Đơn đã thanh toán
        $paidOrders = Order::where('sale_id', $userId)->where('status', 'paid')->count();
        
        // Doanh số (1.8tr x tổng đơn)
        $totalRevenue = $totalOrders * 1800000;

        // Hoa hồng dự kiến (Áp dụng logic KPI bạn vừa yêu cầu)
        $earnings = auth()->user()->monthly_earnings; 
        $expectedCommission = $earnings['total'];


        $status = $request->get('status');
        $query = Order::whereIn('sale_id', $allSaleIds)
        ->whereMonth('created_at', $currentMonth)
        ->whereYear('created_at', $currentYear);

    if ($status) {
        $query->where('status', $status);
    }
        // if ($status) {
        // // Nếu CÓ bấm nút lọc (có status) thì mới lấy dữ liệu từ DB
        // $orders = Order::where('sale_id', $userId)
        //     ->where('status', $status)
        //     ->whereMonth('created_at', $currentMonth)
        //     ->whereYear('created_at', $currentYear)
        //     ->latest()
        //     ->get();
        // } else {
        //     // Nếu KHÔNG có status (mới vào trang) thì trả về mảng rỗng
        //     $orders = collect([]); 
        // }

        // Trả về cho Fetch (AJAX)
        // if ($request->ajax()) {
        //     return view('sale.orders.partials.list', compact('orders'))->render();
        // }
$orders = $query->with('user')->latest()->get();

    if ($request->ajax()) {
        return view('sale.orders.partials.list', compact('orders','defaultPrice',))->render();
    }
        return view('sale.orders.index', compact(
            'totalOrders', 'pendingOrders', 'paidOrders', 'totalRevenue', 'expectedCommission',
            'orders', 
        ));
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