<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('catalog_auth_token')) {

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Please login to continue.',
                    'data' => null,
                ], 401);
            }

            return redirect()->route('home');
        }

        return $next($request);
    }
}
