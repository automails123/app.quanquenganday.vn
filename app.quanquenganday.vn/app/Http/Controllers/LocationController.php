<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ward;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    // public function searchWards(Request $request)
    // {        
    //     $q = $request->q;
    //     $data = Ward::where('wards.name', 'LIKE', "%$q%")       
    //     ->join('provinces', 'wards.province_code', '=', 'provinces.code') 
    //     ->select(
    //         'wards.code', 
    //         'wards.name', 
    //         'provinces.name as p_name', 
    //         'provinces.code as p_code'
    //     )
    //     ->limit(10)->get();
        
    //     // Select2 CHỈ nhận "id" và "text". Bạn để "code" nó sẽ không nhận.
    //     return response()->json($data->map(fn($item) => [
    //         'id' => $item->code, // Bắt buộc là 'id'
    //         'ward_name' => $item->name, // Bắt buộc là 'text'
    //         'province_name' => $item->p_name, 
    //         'province_code'   => $item->p_code
    //     ]));
    // }
        public function searchWards(Request $request)
    {        
        $q = $request->q;
        
        // Nếu không gõ gì thì có thể trả về mảng trống luôn cho nhanh
        if (!$q) {
            return response()->json(['results' => []]);
        }

        $data = Ward::where('wards.name', 'LIKE', "%$q%")       
            ->join('provinces', 'wards.province_code', '=', 'provinces.code') 
            ->select(
                'wards.code', 
                'wards.name', 
                'provinces.name as p_name', 
                'provinces.code as p_code'
            )
            ->limit(15) // Tăng lên 15 cho thoải mái
            ->get();
        
        // Select2 CẦN cấu hình như sau:
        $formattedData = $data->map(fn($item) => [
            'id'   => $item->code, // Select2 dùng cái này để gửi lên server
            'text' => $item->name . " (" . $item->p_name . ")", // Select2 dùng cái này để HIỂN THỊ
            // Bạn có thể giữ lại các trường khác để dùng nếu cần
            'province_name' => $item->p_name, 
            'province_code' => $item->p_code
        ]);

        return response()->json([
            'results' => $formattedData // BẮT BUỘC phải có key 'results'
        ]);
    }
}