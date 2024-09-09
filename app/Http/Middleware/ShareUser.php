<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ShareUser
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            View::share('user', auth()->user());
        }

        return $next($request);
    }
}