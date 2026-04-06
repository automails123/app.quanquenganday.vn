<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ward;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    public function searchWards(Request $request)
    {
        // try {
        //     $search = $request->get('q');

        //     if (empty($search)) {
        //         return response()->json([]);
        //     }

        //     $data = DB::table('wards')
        //         ->join('provinces', 'wards.province_code', '=', 'provinces.code')
        //         ->select(
        //             'wards.code as id', 
        //             'wards.name as ward_name', 
        //             'provinces.name as province_name',
        //             'provinces.code as province_id'
        //         )
        //         ->where('wards.name', 'LIKE', "%$search%")
        //         ->limit(15)
        //         ->get();

        //     return response()->json($data);

        // } catch (\Exception $e) {
        //     return response()->json([
        //         'error' => $e->getMessage()
        //     ], 500);
        // }
        $q = $request->q;
        $data = Ward::where('name', 'LIKE', "%$q%")->limit(10)->get();
        
        // Select2 CHỈ nhận "id" và "text". Bạn để "code" nó sẽ không nhận.
        return response()->json($data->map(fn($item) => [
            'id' => $item->code, // Bắt buộc là 'id'
            'text' => $item->name // Bắt buộc là 'text'
        ]));
    }
}