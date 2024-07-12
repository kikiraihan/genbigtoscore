<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilamentUserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('filament')->check()) {
            return $next($request);
        }

        return redirect('/'); // Halaman tujuan jika pengguna tidak terautentikasi
    }
}
