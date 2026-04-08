<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\BalanceLog;
use App\Models\Commission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CommissionController extends Controller
{
    public function index(Request $request)
    {
        $now = Carbon::now();
        // 1. Lấy danh sách hoa hồng phát sinh gần đây (Mục 6)
        
    $monthlyCommissions = Commission::with('user')
        ->whereMonth('created_at', $now->month)
        ->whereYear('created_at', $now->year)
        ->latest()
        ->paginate(10);
        // 2. Lấy User đang được chọn để quản lý (Mục 8)
        $selectedUser = null;
        if ($request->user_id) {
            $selectedUser = User::find($request->user_id);
        }

        // 3. Lấy lịch sử biến động số dư của User đó
        $balanceLogs = $selectedUser 
            ? BalanceLog::where('user_id', $selectedUser->id)->latest()->take(10)->get() 
            : collect([]);

        return view('admin.commissions.index', compact('monthlyCommissions', 'selectedUser', 'balanceLogs'));
    }

    public function adjustBalance(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
            'type' => 'required|in:plus,minus',
            'description' => 'nullable|string|max:255'
        ]);

        $user = User::findOrFail($id);
        $amount = $request->amount;
        $type = $request->type;

        DB::transaction(function () use ($user, $amount, $type, $request) {
            // Cập nhật số dư User
            if ($type === 'plus') {
                $user->increment('balance', $amount);
            } else {
                $user->decrement('balance', $amount);
            }

            // Ghi log vào bảng balance_logs
            BalanceLog::create([
                'user_id' => $user->id,
                'amount' => $amount,
                'type' => $type,
                'description' => $request->description ?? ($type === 'plus' ? 'Cộng số dư hệ thống' : 'Khấu trừ số dư'),
            ]);
        });

        return back()->with('success', 'Thao tác số dư thành công!');
    }
    public function userDetail($id)
    {
        $user = User::findOrFail($id);
        
        $logs = BalanceLog::where('user_id', $id)->latest()->paginate(15);
        
        $currentMonthCommission = Commission::where('user_id', $id)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('amount');

        // QUAN TRỌNG: Phải có lệnh return view này
        return view('admin.commissions.user_detail', compact('user', 'logs', 'currentMonthCommission'));
    }
}