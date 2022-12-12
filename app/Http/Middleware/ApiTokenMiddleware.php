<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiTokenMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $apiToken = '2a127d0Vo0aF5vPBCnCC690uieYMIpth9WAXGgFqjqGCgF928AstUUq';
        $requestApiToken = $request->input('api_token');
        if ($requestApiToken === $apiToken) {
            return $next($request);
        } else {
            return response()->json([
                'response' => false,
                'message' => 'Api token invalid or empty',
            ], 401);
        }
    }
}
