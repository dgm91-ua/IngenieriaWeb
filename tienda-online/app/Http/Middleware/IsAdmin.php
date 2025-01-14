<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verificamos que esté autenticado y sea admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            // Si no es admin, retornamos 403 - Forbidden o redirigimos
            abort(403, 'No tienes permisos para acceder a esta página.');
        }

        return $next($request);
    }
}
