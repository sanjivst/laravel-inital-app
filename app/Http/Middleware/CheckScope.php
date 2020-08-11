<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckScope
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$scopes)
    {
        if(Auth::user()->scope) {
            if(!$scopes)
            {
                if(Auth::user()->scope->name== "Admin") {
                     return $next($request);
                }
            }
            foreach($scopes as $scope) {
                if(Auth::user()->scope->name== $scope) {
                     return $next($request);
                }
            }
        }
        dd('You Are Not Allowed');
    }
}
