<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckWadirDanKU
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $wadirku)
    {
        if($wadirku == "recent" && auth()->user()->role_id != 1){
            return $next($request);
        }
        abort(404);
    }
}
