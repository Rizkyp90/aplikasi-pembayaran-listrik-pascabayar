<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah pengguna yang login adalah admin (menggunakan guard 'web')
        if (Auth::guard('web')->check()) {
            return $next($request);
        }

        // Jika bukan admin, tendang ke halaman home
        return redirect('/home')->with('error', 'Anda tidak memiliki hak akses admin!');
    }
}