<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authorize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $ability
     * @param  string|null  ...$models
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $ability = null, ...$models)
    {
        if (!Auth::check()) {
            return response('Unauthorized.', 401);
        }

        if ($ability && !$request->user()->can($ability, $models)) {
            return response('Forbidden.', 403);
        }

        return $next($request);
    }
}
