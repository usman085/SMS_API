<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    // public function handle($request, Closure $next, $guard = null)
    // {
    //     if (Auth::guard($guard)->check()) {
    //         return redirect(RouteServiceProvider::HOME);
    //     }

    //     return $next($request);
    // }
    public function handle($request, Closure $next, $guard = null) {
  if (Auth::guard($guard)->check()) {
    $role = Auth::user()->role; 

    switch ($role) {
      case '1':
         return redirect('/home');
         break;
      case '0':
         return redirect('/user');
         break; 

      default:
         return redirect('/login'); 
         break;
    }
  }
  return $next($request);
}
}
