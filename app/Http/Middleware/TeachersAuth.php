<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TeachersAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(session()->get('authentication') == true && session()->get('privilege')==2)
        {
            return $next($request);
        }
          return redirect('sign-in')->with('error','Session Expired');
    }
}
