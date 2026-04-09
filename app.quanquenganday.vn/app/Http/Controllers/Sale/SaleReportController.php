<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;

class SaleReportController extends Controller
{
   public function f1List()
{
    // Lấy danh sách F1 của tài khoản đang đăng nhập
    $f1Sales = auth()->user()->f1s()
        ->withCount(['shops', 'f1s']) // Đếm số quán và số sale do F1 mời
        ->get();

    return view('sale.f1_list', compact('f1Sales'));
}

public function f1Detail($id)
{
    // Đảm bảo người xem chỉ xem được F1 của mình
    $f1 = auth()->user()->f1s()
        ->withCount(['shops', 'f1s'])
        ->findOrFail($id);

    // Lấy thông tin thu nhập của F1 (Sử dụng Accessor bạn đã viết)
    // $earnings = $f1->monthly_earnings; 

    return view('sale.f1_detail', compact('f1', ));
}
}