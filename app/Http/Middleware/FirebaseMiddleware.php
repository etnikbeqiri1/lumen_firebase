<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\Auth\Token\Exception\InvalidToken;
use Kreait\Laravel\Firebase\Facades\Firebase;


class FirebaseMiddleware
{

    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();

        if($token == null){
            return response('Unauthorized.', 401);
        }
        try {
            $verifiedIdToken = Firebase::auth()->verifyIdToken($token);
        } catch (InvalidToken $e) {
             return response($e->getMessage(), 401);
        } catch (\InvalidArgumentException $e) {
            return response($e->getMessage(), 401);
        }

        return $next($request);
    }
}
