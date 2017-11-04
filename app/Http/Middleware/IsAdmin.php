<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
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
    public function handle($request, Closure $next)
    {
        $valid = Auth::user()? Auth::user()->rolesPermissions()['admin'] : false;
        if(!$valid){
            return redirect('unauthorized');
        }
        return $next($request);
    }
}
