<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        
        $query = Shop::query()->with('sale'); // Eager load để lấy thông tin người giới thiệu

        // 1. Tìm kiếm theo tên hoặc điện thoại
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }

        // 2. Lọc theo trạng thái (pending, active,...)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 3. Sắp xếp quán mới nhất lên đầu
        $shops = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.shops.index', compact('shops'));
    }

    // Hàm xem chi tiết quán
    public function show($id)
    {
        $shop = Shop::with('sale')->findOrFail($id);
        return view('admin.shops.show', compact('shop'));
    }

    // Hàm duyệt quán (Đổi trạng thái)
    // public function updateStatus(Request $request, $id)
    // {
    //     $shop = Shop::findOrFail($id);
    //     $shop->update(['status' => $request->status]);

    //     return back()->with('success', 'Đã cập nhật trạng thái quán thành công!');
    // }
    public function updateStatus(Request $request, $id)
{
    try {
        $shop = Shop::findOrFail($id);
        $shop->status = $request->status;
        $shop->save();

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật trạng thái thành công!'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Lỗi: ' . $e->getMessage()
        ], 500);
    }
}
}
