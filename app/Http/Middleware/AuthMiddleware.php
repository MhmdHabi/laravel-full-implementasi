<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must login first.');
        }

        // Cek apakah ini adalah permintaan untuk menghapus pengguna
        if ($request->route()->named('delete_user')) {
            $user = $request->route('user');

            // Cek apakah pengguna yang akan dihapus adalah superadmin atau akun sendiri
            if (Auth::user()->role === 'superadmin' || Auth::id() === $user->id) {
                return redirect()->back()->with('error', 'You cannot delete yourself');
            }
        }

        return $next($request);
    }
}
