<?php

namespace codicastudio\SecureHeaders;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SecureHeadersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return Response
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $headers = (new SecureHeaders(config('secure-header', [])))->headers();

        foreach ($headers as $key => $value) {
            $response->headers->set($key, $value, true);
        }

        return $response;
    }
}
