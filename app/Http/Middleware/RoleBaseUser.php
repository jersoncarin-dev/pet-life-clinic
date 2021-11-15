<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleBaseUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if($user->role == 'ADMIN' || $user->role == 'STAFF') {
            if(str_contains($request->path(),'my/')) {
                return redirect(str_replace('my/','manage/',$request->getRequestUri()));
            }
        }

        foreach($roles as $role) {
            if($user->role === strtoupper($role)) {
                return $next($request);
            }
        }
      
        return abort(401);
    }
}
