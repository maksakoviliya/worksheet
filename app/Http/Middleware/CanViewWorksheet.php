<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CanViewWorksheet
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
        if (Auth::user()->hasRole('admin')) {
            return $next($request);
        } elseif (Auth::user()->hasRole('head') && Auth::user()->filial_id === $request->worksheet->filial_id) {
            return $next($request);
        } elseif (Auth::user()->hasRole('user') && Auth::user()->id === $request->worksheet->user_id) {
            return $next($request);
        }
        abort(403, 'User does not have the right roles.');
    }
}
