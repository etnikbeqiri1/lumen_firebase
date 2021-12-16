<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\Auth\Token\Exception\InvalidToken;
use Kreait\Laravel\Firebase\Facades\Firebase;

class FirebaseRoleDistributorMiddleware
{
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();

        if ($token == null) {
            return response('Unauthorized', 401);
        }
        try {
            $verifiedIdToken = Firebase::auth()->verifyIdToken($token);
            $fbdata = $verifiedIdToken->claims();
            $user = Firebase::auth()->getUser($fbdata->get('sub'));
            if ($user->customClaims['role'] !== "distributor"){
                return response("Unauthorized",401);
            }
        } catch (InvalidToken $e) {
            return response($e->getMessage(), 401);
        } catch (\InvalidArgumentException $e) {
            return response($e->getMessage(), 401);
        }
        $request->request->add(['user' => $user]);
        return $next($request);
    }
}
