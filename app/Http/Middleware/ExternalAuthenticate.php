<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ExternalAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $externalUser = User::where('username', '=', $request->get('token'))
                            ->first();

        if ($externalUser != null) {
            if (! $externalUser->isExternalApiUser()) {
                return response('Unauthorized.', 401);
            }
        } else {
            return response('Unauthorized.', 401);
        }

        return $next($request);
    }
}
