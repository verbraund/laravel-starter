<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        //Content-type
        $response->headers->set(
            'X-Content-Type-Options',
            'nosniff'
        );

        //Iframe
        $response->headers->set(
            'X-Frame-Options',
            'SAMEORIGIN'
        );

        //Referrer
        $response->headers->set(
            'Referrer-Policy',
            'strict-origin-when-cross-origin'
        );

        //Disable services
        $response->headers->set(
            'Permissions-Policy',
            'camera=(), microphone=(), geolocation=()'
        );

        return $response;
    }
}