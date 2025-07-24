<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsRedaktur
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle($request, $next)
    // {
    //     if (! auth()->check()) {
    //         return $next($request); // Pengguna tidak login, biarkan akses
    //     }

    //     if (auth()->user()->role === 'redaktur') {
    //         return $next($request); // Role admin → boleh lewat
    //     }

    //     return $next($request); // Jika bukan admin, tetap lewatkan ke halaman utama
    // }

    public function handle(Request $request, Closure $next)
    {
        return app(\App\Http\Middleware\EnsureUserHasRole::class)->handle($request, $next, 'redaktur');
    }
}
