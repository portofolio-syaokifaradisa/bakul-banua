<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UmkmMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('umkm')->check()){
            return $next($request);
        }

        return to_route('login')->with('error', 'Akses Ditolak!');
    }
}
