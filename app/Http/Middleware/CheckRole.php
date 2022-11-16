<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        if($role == 'pegawai' && auth()->user()->role_id ==1){
            return $next($request);
        }
        if($role == 'kepalabagian' && auth()->user()->role_id ==2){
            return $next($request);
        }
        if($role == 'wakildirektur2' && auth()->user()->role_id ==3){
            return $next($request);
        }
        if($role == 'bagiankepegawaian' && auth()->user()->role_id ==4){
            return $next($request);
        }

        abort(403);
        
    }
}
