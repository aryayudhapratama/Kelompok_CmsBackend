<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Http\Request;

class CustomLoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();

        // Redirect berdasarkan role
        if ($user->role_id === 1) {
            return redirect()->intended('/admin');
        } elseif ($user->role_id === 2) {
            return redirect()->intended('/redaktur');
        } elseif ($user->role_id === 3) {
            return redirect()->intended('/reporter');
        }

        // Default redirect (jika role tidak dikenali)
        return redirect()->intended('/');
    }
}