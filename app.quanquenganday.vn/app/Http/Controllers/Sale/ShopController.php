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
        $user = Auth::user();
        
        $query = Shop::query();

        // Phân quyền: Admin thấy hết, Sale thấy quán của mình
        if ($user->role !== 'admin') {
            $query->where('sale_id', $user->id);
        }

        // Nếu có tìm kiếm (Search)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }

        $shops = $query->latest()->paginate(10);

        return view('admin.shops.index', compact('shops'));
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
