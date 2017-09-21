<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PagesMiddleware
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
       
        if ($request->is('pages/*/edit')){
            if (!Auth::user()->hasPermissionTo('Edit Pages')) {
                abort('401');
            }else {
                return $next($request);
            }
        }

         if ($request->is('pages/*')){
            if (!Auth::user()->hasPermissionTo('View Pages')) {
                abort('401');
            }else {
                return $next($request);
            }
        }

     
        return $next($request);
    }

}
