<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Http\Request;

class UserLocationController extends Controller
{
   public function index() {
        $users = User::with('wards')->get();
        return view('admin.assign-wards.index', compact('users'));
    }

    public function store(Request $request) {
        $user = User::findOrFail($request->user_id);
        // sync() tự động thêm mới, xóa cái cũ không có trong mảng
        $user->wards()->sync($request->ward_codes);
        return back()->with('success', 'Cập nhật thành công!');
    }

    // API cho Select2 tìm kiếm từ bảng wards
    public function searchWards(Request $request) {
        $q = $request->q;
        $data = Ward::where('name', 'LIKE', "%$q%")
                    ->limit(10)
                    ->get(['code', 'name']);
                    
        return response()->json($data->map(fn($item) => [
            'id' => $item->code, 
            'text' => $item->name
        ]));
    }
}