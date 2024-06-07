<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

class RefreshToken
{
    public function handle($request, Closure $next)
    {
        try {
            // Check if the token is valid
            $user = JWTAuth::parseToken()->authenticate();
        } catch (TokenExpiredException $e) {
            // Attempt to refresh the token
            try {
                $newToken = JWTAuth::refresh(JWTAuth::getToken());
                // Set the new token in the request headers
                $request->headers->set('Authorization', 'Bearer ' . $newToken);

                // Proceed with the request
                $response = $next($request);

                // Set the new token in the response headers
                $response->headers->set('Authorization', 'Bearer ' . $newToken);
                return $response;
            } catch (JWTException $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Token is expired and cannot be refreshed'
                ], 401);
            }
        } catch (TokenInvalidException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Token is invalid'
            ], 401);
        } catch (JWTException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Token is absent'
            ], 401);
        }

        return $next($request);
    }
}
