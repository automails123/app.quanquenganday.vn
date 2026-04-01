<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\BalanceLog;
use App\Models\SystemNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderApprovalController extends Controller
{
    /**
     * Hiển thị danh sách đơn hàng chờ duyệt
     */
    public function index()
    {
        $orders = Order::with(['shop', 'sale'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Xử lý duyệt đơn hàng và cộng tiền
     */
    public function approve($id)
    {
        return DB::transaction(function () use ($id) {
            // Khóa dòng dữ liệu để tránh duyệt trùng nếu bấm nhanh
            $order = Order::where('id', $id)
                ->where('status', 'pending')
                ->lockForUpdate()
                ->first();

            if (!$order) {
                return back()->with('error', 'Đơn hàng không tồn tại hoặc đã được xử lý.');
            }

            // 1. Cập nhật trạng thái đơn hàng
            $order->update(['status' => 'paid']);

            // 2. Cộng tiền vào số dư (balance) của Sale
            $sale = User::find($order->sale_id);
            $sale->increment('balance', $order->commission);

            // 3. Ghi log biến động số dư để đối soát
            BalanceLog::create([
                'user_id' => $sale->id,
                'amount' => $order->commission,
                'type' => 'plus',
                'description' => "Hoa hồng duyệt đơn: " . $order->order_code,
            ]);

            // 4. Bắn thông báo "Chuông" cho Sale
            SystemNotification::create([
                'user_id' => $sale->id,
                'title' => 'Đơn hàng đã được duyệt',
                'content' => "Đơn {$order->order_code} thành công. Bạn nhận được +" . number_format($order->commission) . "đ",
                'type' => 'admin', // Hiện icon loa/thông báo admin theo mẫu
            ]);

            return back()->with('success', 'Đã duyệt đơn và cộng tiền cho Sale thành công!');
        });
    }

    /**
     * Từ chối đơn hàng
     */
    public function reject(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'cancelled']);

        // Thông báo cho Sale lý do từ chối
        SystemNotification::create([
            'user_id' => $order->sale_id,
            'title' => 'Đơn hàng bị từ chối',
            'content' => "Đơn {$order->order_code} không được duyệt. Lý do: " . ($request->reason ?? 'Thông tin không hợp lệ'),
            'type' => 'admin',
        ]);

        return back()->with('info', 'Đã từ chối đơn hàng.');
    }
}