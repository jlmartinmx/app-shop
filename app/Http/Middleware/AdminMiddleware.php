<?php

namespace App\Http\Middleware;

use Closure;

// 40 0:0
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){

        if(!auth()->user()->admin){
            // si no es admin envialo al home
            return redirect('/');
        }

        return $next($request);
    }
}
