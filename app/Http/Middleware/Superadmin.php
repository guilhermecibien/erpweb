<?php

namespace App\Http\Middleware;

use Closure;

class Superadmin
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
        $administrator_list = config('constants.administrator_usernames', '');
        $user = $request->user();

        // Normalize values from .env (spaces/newlines) to avoid false 403.
        $administrators = array_filter(array_map('trim', explode(',', (string) $administrator_list)));

        if (!empty($user) && in_array(trim((string) $user->username), $administrators, true)) {
            return $next($request);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}
