<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserLogin
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
        $allowed_user_types = ['user', 'admin'];

        if (!in_array((string) $request->user()->user_type, $allowed_user_types, true)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
