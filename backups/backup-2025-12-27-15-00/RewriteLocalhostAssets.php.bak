<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RewriteLocalhostAssets
{
    /**
     * Handle an incoming request.
     * Replace absolute localhost asset URLs in HTML responses with the current request host (dev only).
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (app()->environment('local') && $response instanceof Response) {
            $contentType = $response->headers->get('Content-Type') ?: '';

            if (str_contains($contentType, 'text/html')) {
                $body = $response->getContent();
                $host = $request->getSchemeAndHttpHost();

                // Replace common local dev host variants (with and without port)
                $patterns = [
                    'http://localhost:8000',
                    'http://127.0.0.1:8000',
                    'http://localhost',
                    'http://127.0.0.1',
                ];

                $body = str_replace($patterns, $host, $body);
                $response->setContent($body);
            }
        }

        return $response;
    }
}
