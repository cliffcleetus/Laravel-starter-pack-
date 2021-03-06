<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class CheckLoginMiddleware
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

        
      if(Auth::user()->hasRole('SuperAdmin'))
      {
        return $next($request);
      }
      else if(Auth::user()->hasRole('Admin'))
      {
        return $next($request);
      }
      else if(Auth::user()->hasRole('User'))
      {
        return redirect('/');
      }


        
    }
}
