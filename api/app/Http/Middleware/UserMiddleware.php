<?php

namespace App\Http\Middleware;

use App\Models\Constants\UserRoles;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() && Auth::user()->role === UserRoles::USER) {
            return $next($request);
        } else if (Auth::user() && Auth::user()->role !== UserRoles::USER) {
            return response()->json(['error' => 'Forbidden'], JsonResponse::HTTP_FORBIDDEN);
        }
        return response()->json(['error' => 'Unauthorized'], JsonResponse::HTTP_UNAUTHORIZED);
    }
}
