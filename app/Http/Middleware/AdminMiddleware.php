<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Tambahkan ini

class AdminMiddleware
{
    /**
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    { 
        if (Auth::check() && Auth::user()->isAdmin()) { // Pastikan pengguna sudah login dan memiliki peran 'Admin RT'
            return $next($request);
        }
        return redirect('/home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');// Jika tidak, arahkan kembali ke '/home' dengan pesan error
    }
}