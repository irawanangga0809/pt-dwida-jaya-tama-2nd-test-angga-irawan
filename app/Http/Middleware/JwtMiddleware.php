<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Resources\ResponseResource;
use Tymon\JWTAuth\Exceptions\JWTException;

class JwtMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            return (new ResponseResource(false, 'Token tidak valid',null,)) 
                ->response()
                ->setStatusCode(401);
        }

        return $next($request);
    }
}
