<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAllowedIps
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(
            count($this->getAllowedIps()) > 0 and
            !in_array($request->getClientIp(), $this->getAllowedIps())
        ){
            abort(404);
        }
        return $next($request);
    }

    protected function getAllowedIps()
    {
        return array_filter(explode(',', config('auth.allowed_ips', '')), function($ip){
            return trim($ip) != '';
        });
    }
}
