<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
           if (Auth::guard($guard)->check()) {
                // Redirect berdasarkan role pengguna
                if (auth()->user()->role === 'admin') {
                    return redirect('/admin');
                } elseif (auth()->user()->role === 'redaktur') {
                    return redirect('/redaktur');
                } elseif (auth()->user()->role === 'reporter') {
                    return redirect('/reporter');
                }
            }
        }

        return $next($request);
    }
}
