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
        if ($user->role === 'admin') {
            return redirect()->intended('/admin');
        } elseif ($user->role === 'redaktur') {
            return redirect()->intended('/redaktur');
        } elseif ($user->role === 'reporter') {
            return redirect()->intended('/reporter');
        }

        // Default redirect (jika role tidak dikenali)
        return redirect()->intended('/');
    }
}