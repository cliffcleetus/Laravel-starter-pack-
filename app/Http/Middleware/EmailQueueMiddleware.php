<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EmailQueueMiddleware
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
        if ($request->is('emailqueues/*')){
            if (!Auth::user()->hasPermissionTo('View Email Queues')) {
                abort('401');
            }else {
                return $next($request);
            }
        }

         if ($request->is('emailqueues/resend/*')){
            if (!Auth::user()->hasPermissionTo('Resend Email')) {
                abort('401');
            }else {
                return $next($request);
            }
        }

     
        return $next($request);
    }
}
