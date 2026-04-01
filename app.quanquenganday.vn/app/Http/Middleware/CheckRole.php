<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Kiểm tra xem người dùng đã đăng nhập chưa
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Kiểm tra xem role của user có khớp với role yêu cầu không
        // Ví dụ: User là 'sale' nhưng muốn vào trang yêu cầu role 'admin'
        if (Auth::user()->role !== $role) {
            // Trả về lỗi 403 (Không có quyền) hoặc chuyển hướng
            abort(403, 'Bạn không có quyền truy cập vào khu vực này.');
        }

        return $next($request);
    }
}