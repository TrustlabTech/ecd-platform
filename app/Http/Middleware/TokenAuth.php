<?php

namespace App\Http\Middleware;

use Closure;
use Config;

use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class TokenAuth
{
    public function __construct()
    {
    }

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
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'User Auth Failed'], 401);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'Token Expired'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'Token Invalid'], 401);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token Absent'], 401);
        }

        return $next($request);
    }
}
