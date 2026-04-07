<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Tìm kiếm theo tên, email hoặc mã Sale
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('affiliate_id', 'LIKE', "%{$search}%"); // Nếu bạn có cột mã định danh
            });
        }

        $users = $query->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }
    public function updateQuick(Request $request, $id)
    {
        
        $user = User::findOrFail($id);
        
        $request->validate([
        'role' => 'required|in:admin,sale,ctv,user',
        'status' => 'required|in:active,pending,blocked',

    ]);
        
        // 3. Cập nhật dữ liệu
    $user->update([
        'role' => $request->role,
        'status' => $request->status,
    ]);

    $user->save();

        return back()->with('success', 'Đã cập nhật thông tin user ' . $user->name . ' thành công!');
    }
    public function cccdIndex()
    {
        $users = User::whereIn('cccd_status', ['processing','pending', 'rejected']) // Hoặc lấy tất cả tùy
                    ->latest()
                    ->paginate(12);
        return view('admin.users.cccd', compact('users'));
    }

    // Hàm xử lý duyệt
    public function verifyCCCD($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'cccd_status' => 'approved',
            'cccd_verified_at' => now(),
            'status' => 'active' // Tự động kích hoạt tài khoản luôn
        ]);

        return back()->with('success', 'Đã duyệt xác minh cho ' . $user->name);
    }

    public function updateCCCDImages(Request $request, $id)
{
    $user = User::findOrFail($id);

    if ($request->hasFile('cccd_front_image')) {
        $path = $request->file('cccd_front_image')->store('users/cccd', 'public');
        $user->cccd_front_image = basename($path);
    }

    if ($request->hasFile('cccd_back_image')) {
        $path = $request->file('cccd_back_image')->store('users/cccd', 'public');
        $user->cccd_back_image = basename($path);
    }

    // Nếu Admin tự upload hộ, mình chuyển sang trạng thái chờ duyệt luôn
    $user->cccd_status = 'processing';
    
    $user->save();

    return back()->with('success', 'Đã cập nhật ảnh CCCD thành công!');
}
}
