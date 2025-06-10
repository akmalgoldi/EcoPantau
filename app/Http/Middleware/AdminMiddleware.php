<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Tambahkan ini

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan pengguna sudah login dan memiliki peran 'Admin RT'
        if (Auth::check() && Auth::user()->isAdmin()) {
            return $next($request);
        }

        // Jika tidak, arahkan kembali ke '/home' dengan pesan error
        return redirect('/home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}