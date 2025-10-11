<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Si el usuario ya está autenticado, redirigirlo a su dashboard correspondiente
        if (Auth::check()) {
            if (Auth::user()->es_escritor) {
                return redirect()->route('admin.index');
            } else {
                return redirect()->route('usuario.dashboard');
            }
        }

        return $next($request);
    }
}
