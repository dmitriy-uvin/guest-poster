<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        if ($this->authenticate($request, $guards) === 'authentication_failed') {
            return response()->json(['error'=>'Unauthorized'],400);
        } else if (Auth::user()->blocked) {
            return response()->json(['error'=>'blocked'],403);
        }
        return $next($request);
    }
}
