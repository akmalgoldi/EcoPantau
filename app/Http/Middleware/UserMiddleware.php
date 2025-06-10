<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Tambahkan ini

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan pengguna sudah login dan memiliki peran 'Warga'
        if (Auth::check() && Auth::user()->isUser()) {
            return $next($request);
        }

        // Jika tidak, arahkan kembali ke '/admin/dashboard' dengan pesan error
        // Asumsi admin tidak boleh mengakses route user
        return redirect('/admin/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}