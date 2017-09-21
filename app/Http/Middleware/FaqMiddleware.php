<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class FaqMiddleware
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
       
        if ($request->is('faq/create')){
            if (!Auth::user()->hasPermissionTo('Create FAQ')){
                abort('401');
            }else{
                return $next($request);
            }
        }

        if ($request->is('faq/*/edit')){
            if (!Auth::user()->hasPermissionTo('Edit FAQ')) {
                abort('401');
            }else {
                return $next($request);
            }
        }

         if ($request->is('faq/*')){
            if (!Auth::user()->hasPermissionTo('View FAQ')) {
                abort('401');
            }else {
                return $next($request);
            }
        }

         if ($request->isMethod('Delete')){
            if (!Auth::user()->hasPermissionTo('Delete FAQ')) {
                abort('401');
            }else{
                return $next($request);
            }
        }

        return $next($request);
    }

}
