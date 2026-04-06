<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller {

    // TRƯỜNG HỢP 1: Admin gửi toàn bộ hoặc theo Nhóm
    public function sendFromAdmin(Request $request) {
        $notif = Notification::create([
            'sender_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
            'type' => 'admin',
            'image' => $request->image_path // Nếu có
        ]);

        $users = User::all()->pluck('id'); // Hoặc lọc theo role
        $notif->users()->attach($users);
        return response()->json(['success' => true]);
    }

    // TRƯỜNG HỢP 2: Hệ thống tự động khi có Quán mới/Sale mới
    // Gọi hàm này trong StoreController hoặc SaleController
    public static function sendSystemNotif($receiverId, $title, $content, $url = null) {
        $notif = Notification::create([
            'title' => $title,
            'content' => $content,
            'type' => 'system',
            'action_url' => $url
        ]);
        $notif->users()->attach($receiverId);
    }

    // TRƯỜNG HỢP 3: User này gửi cho User kia bất kỳ
    public function sendUserToUser(Request $request) {
        $notif = Notification::create([
            'sender_id' => auth()->id(),
            'title' => 'Tin nhắn mới từ ' . auth()->user()->name,
            'content' => $request->content,
            'type' => 'user_to_user'
        ]);
        $notif->users()->attach($request->receiver_id);
        return response()->json(['success' => true]);
    }

    // Đánh dấu đã đọc
    public function markAsRead($id) {
        auth()->user()->notifications()->updateExistingPivot($id, ['read_at' => now()]);
        return response()->json(['success' => true]);
    }
    public function create() {
        // Lấy danh sách user để nếu muốn gửi đích danh (tùy chọn)
        $users = User::where('role', '!=', 'admin')->get();
        return view('admin.notifications.create', compact('users'));
    }
    public function store(Request $request) {
        // 1. Validate dữ liệu
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|max:5120'
        ]);

        // 2. Xử lý upload ảnh (nếu có)
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('notifications', 'public');
        }

        // 3. Tạo thông báo gốc trong bảng notifications
        $notification = Notification::create([
            'sender_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
            'type' => 'admin', // Loại do admin tạo
            'image' => $imagePath,
        ]);

        // 4. Bắn thông báo này cho TẤT CẢ User (trừ chính Admin)
        $userIds = User::where('id', '!=', auth()->id())->pluck('id');
        
        // Lưu vào bảng trung gian notification_user
        $notification->users()->attach($userIds);

        // Thay vì return response()->json...
        return redirect()->route('admin.notifications.create')->with('success', 'Đã gửi thông báo thành công!');
    }

    public static function sendSystemNotification($receiverIds, $title, $content, $type = 'system') 
    {
        // 1. Tạo nội dung gốc
        $notification = \App\Models\Notification::create([
            'sender_id' => null,
            'title' => $title,
            'content' => $content,
            'type' => $type,
        ]);

        // 2. Gán cho danh sách ID người nhận (có thể là 1 ID hoặc 1 mảng ID)
        $notification->users()->attach($receiverIds);
    }

}
