<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuthMiddleware
{
    public function handle(Request $request, Closure $next) {
        if(!$request->session()->has('email') || !$request->session()->has('rol') || $request->session()->get('rol') !== 'admin') {
            return redirect('/admin');
        }

        return $next($request);
    }
}
