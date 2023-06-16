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
        // Check if the user has the required role
        if ($request->user() && $request->user()->rol_user_id == $role) {
            return $next($request);
        }else{
        // If the user does not have the required role redirect
            return redirect()->back();
        }
    }
}
