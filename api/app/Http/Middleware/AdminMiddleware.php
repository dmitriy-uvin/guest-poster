<?php

namespace App\Http\Middleware;

use App\Models\Constants\UserRoles;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() && Auth::user()->role === UserRoles::ADMIN) {
            return $next($request);
        } else if (Auth::user() && Auth::user()->role !== UserRoles::ADMIN) {
            return response()->json(['error' => 'Forbidden'], 403);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
