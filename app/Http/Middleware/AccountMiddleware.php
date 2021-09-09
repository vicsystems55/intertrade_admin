<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AccountMiddleware
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
        if(Auth::check() && Auth::user()->role == "accounts"){

            return $next($request); 
            }

            else{

                abort(403);
            }
    }
}
