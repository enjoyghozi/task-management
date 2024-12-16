<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $is_admin): Response
    {
        if (auth()->user()->is_admin !== $is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}
