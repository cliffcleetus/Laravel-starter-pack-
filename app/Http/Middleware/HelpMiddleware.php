<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class HelpMiddleware
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
       
        if ($request->is('helps/create')){
            if (!Auth::user()->hasPermissionTo('Create Help')){
                abort('401');
            }else{
                return $next($request);
            }
        }

        if ($request->is('helps/*/edit')){
            if (!Auth::user()->hasPermissionTo('Edit Help')) {
                abort('401');
            }else {
                return $next($request);
            }
        }

         if ($request->is('helps/*')){
            if (!Auth::user()->hasPermissionTo('View Help')) {
                abort('401');
            }else {
                return $next($request);
            }
        }

        if ($request->isMethod('Delete')){
            if (!Auth::user()->hasPermissionTo('Delete Help')) {
                abort('401');
            }else{
                return $next($request);
            }
        }

        return $next($request);
    }



      
        
       
  
}
