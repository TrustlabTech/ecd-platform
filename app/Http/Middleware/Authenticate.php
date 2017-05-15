<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
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
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login')->with('danger', 'Please Log In');
            }
        }

        if (Auth::user()->isStaff()) {
            return redirect()->guest('login')->with('danger', 'Please Log In');
        }

        if (Auth::user()->isExternalUser()) {
            return redirect()->guest('login')->with('danger', 'Please Log In');
        }

        if (Auth::user()->isExternalApiUser()) {
            return redirect()->guest('login')->with('danger', 'Please Log In');
        }

        return $next($request);
    }
}
