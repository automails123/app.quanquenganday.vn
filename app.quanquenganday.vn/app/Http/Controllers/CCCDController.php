<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CCCDController extends Controller
{
    public function upload(Request $request)
    {
        // 1. Validate file
        $request->validate([
            'front_image' => 'required|image|mimes:jpeg,png,jpg|max:5120', // Max 5MB
            'back_image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $user = auth()->user();

        // 2. Xử lý upload và lưu vào thư mục private (storage/app/cccd)
        // Không nên lưu ở public để bảo mật thông tin cá nhân
        if ($request->hasFile('front_image')) {
            // Xóa ảnh cũ nếu có
            if ($user->cccd_front_image) {
                Storage::delete($user->cccd_front_image);
            }
            $pathFront = $request->file('front_image')->store('cccd', 'local');
            $user->cccd_front_image = $pathFront;
        }

        if ($request->hasFile('back_image')) {
            if ($user->cccd_back_image) {
                Storage::delete($user->cccd_back_image);
            }
            $pathBack = $request->file('back_image')->store('cccd', 'local');
            $user->cccd_back_image = $pathBack;
        }

        // 3. Cập nhật trạng thái chờ duyệt
        $user->cccd_status = 'processing'; // Đang chờ xử lý
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Đã tải lên ảnh CCCD thành công, vui lòng chờ duyệt.',
            'redirect' => route('verify.index') // Quay lại trang xác minh
        ]);
    }
}