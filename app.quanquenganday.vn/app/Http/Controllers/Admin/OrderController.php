<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index()
    {
        // Lấy danh sách đơn hàng, nạp sẵn sale và shop để không bị chậm (Eager Loading)
        $orders = Order::with(['sale', 'shop'])->latest()->paginate(12);
        return view('admin.orders.index', compact('orders'));
    }

    public function approve($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'completed'; // Hoặc trạng thái bạn quy định
        $order->save();

        return back()->with('success', 'Đã duyệt thanh toán cho đơn ' . $order->order_code);
    }

    public function reject($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'rejected';
        $order->save();

        return back()->with('success', 'Đã từ chối đơn hàng.');
    }
    

    public function updateCCCDImages(Request $request, $id)
    {
        $user = \App\Models\User::findOrFail($id);

        // Validate file gửi lên (nên giới hạn dung lượng và định dạng)
        $request->validate([
            'cccd_front_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'cccd_back_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Xử lý mặt trước
        if ($request->hasFile('cccd_front_image')) {
            // Xóa ảnh cũ nếu tồn tại để đỡ rác server
            if ($user->cccd_front_image) {
                Storage::disk('public')->delete($user->cccd_front_image);
            }
            $user->cccd_front_image = $request->file('cccd_front_image')->store('cccd', 'public');
        }

        // Xử lý mặt sau
        if ($request->hasFile('cccd_back_image')) {
            if ($user->cccd_back_image) {
                Storage::disk('public')->delete($user->cccd_back_image);
            }
            $user->cccd_back_image = $request->file('cccd_back_image')->store('cccd', 'public');
        }

        // Tự động chuyển trạng thái sang 'processing' (Đang chờ duyệt) sau khi up ảnh
        if ($user->cccd_status === 'pending' || $user->cccd_status === 'rejected') {
            $user->cccd_status = 'processing';
        }

        $user->save();

        return back()->with('success', 'Đã cập nhật ảnh hồ sơ thành công!');
    }
}
