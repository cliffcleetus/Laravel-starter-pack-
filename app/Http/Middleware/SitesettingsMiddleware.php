<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SitesettingsMiddleware
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
       
        if ($request->is('settings/*/edit')){
            if (!Auth::user()->hasPermissionTo('Edit Site Settings')) {
                abort('401');
            }else {
                return $next($request);
            }
        }

         if ($request->is('settings/*')){
            if (!Auth::user()->hasPermissionTo('View Site Settings')) {
                abort('401');
            }else {
                return $next($request);
            }
        }

     
        return $next($request);
    }
}
