<?php

namespace App\Http\Middleware;

use Closure;

class role
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
        if(auth()->user()->role == "Project Manager"){
            return $next($request);
        }
        if(auth()->user()->role == "Developer"){
            return $next($request);
        }
        if(auth()->user()->role == "Tester"){
            return $next($request);
        }
   
        return redirect(‘home’)->with(‘error’,"You don't have admin access.");
    }
}
