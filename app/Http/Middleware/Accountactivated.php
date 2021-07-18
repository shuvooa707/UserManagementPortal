<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Accountactivated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // dd( auth()->user()->email_verified_at );
        // if email is varified
        if ( auth()->user()->email_verified_at ) {
            return $next($request);
        } else {
            return redirect("verifyemail");
        }
    }
}
