<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commission;
use App\Models\User;

class CommissionController extends Controller
{
    public function index(Request $request) {
    // Lấy danh sách hoa hồng theo tháng (Mục 6 trong ảnh)
        $monthlyCommissions = Commission::with('user')
            ->latest()
            ->paginate(10);

        // Nếu có tìm kiếm User cụ thể để quản lý (Mục 8 trong ảnh)
        $selectedUser = null;
        if ($request->user_id) {
            $selectedUser = User::find($request->user_id);
        }

        return view('admin.commissions.index', compact('monthlyCommissions', 'selectedUser'));
    }

    public function adjustBalance(Request $request, $id) {
        $user = User::findOrFail($id);
        $amount = str_replace(['.', ','], '', $request->amount); // Xử lý định dạng tiền

        if ($request->type === 'plus') {
            $user->increment('balance', $amount);
            $note = "Cộng số dư: " . number_format($amount) . "đ";
        } else {
            $user->decrement('balance', $amount);
            $note = "Trừ số dư: " . number_format($amount) . "đ";
        }

        // Nên lưu lại lịch sử biến động số dư vào bảng khác nếu cần
        return back()->with('success', 'Đã thực hiện: ' . $note);
    }
}
