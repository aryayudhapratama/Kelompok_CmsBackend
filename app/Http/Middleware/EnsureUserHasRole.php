<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Cek apakah user sudah login
        if (!auth()->check()) {
            // Redirect ke login, jangan ke `/`
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = auth()->user();

        // 2. Cek apakah relasi role ada dan nama sesuai
        if (!$user->role || $user->role->name !== $role) {
            return redirect('/')
                ->with('error', "Anda tidak memiliki akses. Diperlukan role: {$role}.");
        }

        // 3. Lanjutkan request
        return $next($request);
    }
}