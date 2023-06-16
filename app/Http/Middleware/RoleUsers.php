<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleUsers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Verificar si el usuario tiene el rol requerido
        if ($request->user() && $request->user()->rol_user_id == $role) {
            return $next($request);
        }else{
        // Si el usuario no tiene el rol requerido, redirigir o mostrar un mensaje de error
            return redirect()->back()->with('error', 'Access denied');
        }
    }
}
