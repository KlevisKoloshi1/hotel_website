<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenAuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $authorization = $request->header('Authorization', '');
        if (preg_match('/Bearer\s+(\S+)/', $authorization, $m)) {
            $token = $m[1];
            $user = User::where('api_token', $token)->first();
            if ($user) {
                // Optionally set user on request
                $request->setUserResolver(fn () => $user);
                return $next($request);
            }
        }
        return response()->json(['message' => 'Unauthorized'], 401);
    }
}


