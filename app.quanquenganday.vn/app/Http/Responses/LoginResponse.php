<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Auth;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = Auth::user();

        // Nếu là Admin thì vào dashboard admin
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Ngược lại (là Sale) thì vào dashboard sale
        return redirect()->route('sale.dashboard');
    }
}