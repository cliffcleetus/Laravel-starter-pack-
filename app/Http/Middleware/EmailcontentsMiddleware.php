<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EmailcontentsMiddleware
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
       
        if ($request->is('emailcontents/*/edit')){
            if (!Auth::user()->hasPermissionTo('Edit Email Contents')) {
                abort('401');
            }else {
                return $next($request);
            }
        }

         if ($request->is('emailcontents/*')){
            if (!Auth::user()->hasPermissionTo('View Email Contents')) {
                abort('401');
            }else {
                return $next($request);
            }
        }

     
        return $next($request);
    }
}
