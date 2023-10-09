<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!$request->user() || $request->user()->role->name !== $role) {
           return response()->json(['message' => 'Anda Tidak Memiliki Izin Untuk Mengakses Halaman Ini'], 403);
        }

        return $next($request);
    }
}
