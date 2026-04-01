<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Gate;

class SettingController extends Controller
{
    public function index()
    {
        // Lấy toàn bộ settings ra hiển thị
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function store(Request $request)
    {
        // Chặn thêm một lần nữa cho an toàn tuyệt đối
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $data = $request->except('_token');

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return back()->with('success', 'Cấu hình hệ thống đã được cập nhật!');
    }
}
