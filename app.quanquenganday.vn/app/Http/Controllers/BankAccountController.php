<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankAccount;
class BankAccountController extends Controller
{
    public function index()
    {
        // Lấy thông tin ngân hàng đã lưu của user (nếu có)
        $bank = auth()->user()->bankAccount; 
        return view('profile.bank-account', compact('bank'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'bank_name' => 'required',
            'account_number' => 'required',
            'account_holder' => 'required',
            'branch' => 'nullable|string|max:255',
        ], [
            'bank_name.required' => 'Vui lòng chọn ngân hàng.',
            'account_number.required' => 'Số tài khoản không được để trống.',
            'account_holder.required' => 'Vui lòng nhập tên chủ tài khoản.',
        ]);

        // Lưu hoặc Cập nhật (UpdateOrCreate giúp user chỉ có 1 bản ghi ngân hàng duy nhất)
        BankAccount::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'bank_name' => $request->bank_name,
                'account_number' => $request->account_number,
                'account_holder' => strtoupper($request->account_holder),
                'branch' => $request->branch,
            ]
        );

        return redirect()->route('profile.show')->with('status', 'Cập nhật ngân hàng thành công!');
    }
}
