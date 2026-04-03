<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    
    public function index()
    {
        // Dùng eager loading 'sale' nếu cần, và sắp xếp mới nhất lên đầu
        $shops = Shop::where('sale_id', Auth::id())
                    ->latest()
                    ->get();

        // Đếm tổng số để hiển thị con
        $totalCount = $shops->count();

        return view('sale.shops.index', compact('shops', 'totalCount'));
    }

    /**
     * Xem chi tiết một quán (Nếu cần)
     */
    
    public function show($id)
    {
        // Tìm quán theo ID và đảm bảo quán đó thuộc về Sale đang đăng nhập
        $shop = Shop::where('sale_id', auth()->id())->findOrFail($id);

        return view('sale.shops.show', compact('shop'));
    }
}
