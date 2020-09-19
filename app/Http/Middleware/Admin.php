<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
//use Illuminate\Auth\Middleware\Authenticate as Middleware;
class Admin
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
        if($request->user()->role !='admin'){
            return redirect()->back()->with('status', 'You may not access to admin dashboard!');;
        }
        return $next($request);
       
    }
}
