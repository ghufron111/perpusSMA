<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OnlyGuest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika pengguna sudah login, arahkan mereka ke dashboard sesuai peran
        if (Auth::check()) {
            $user = Auth::user();

            // Jika peran adalah admin, arahkan ke admin.dashboard
            if ($user->role_id === 1) {
                return redirect()->route('admin.dashboard');
            }

            // Jika peran adalah client, arahkan ke client.dashboard
            if ($user->role_id === 2) {
                return redirect()->route('client.dashboard');
            }
        }

        // Jika pengguna belum login, lanjutkan ke tindakan berikutnya
        return $next($request);
    }
}
