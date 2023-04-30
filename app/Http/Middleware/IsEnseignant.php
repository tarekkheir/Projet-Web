<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsEnseignant
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
        if($request->user()->isEnseignant()) {
            return $next($request);
        } else {
             abort(403,'You are not enseignant');
        }
    }
}
