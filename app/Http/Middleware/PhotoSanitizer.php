<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class PhotoSanitizer
 *
 * @package App\Http\Middleware
 */
class PhotoSanitizer
{
    /**
     * Handle an incoming request.
     *
     * @param  Request $request
     * @param  Closure $next
     *
     * @return RedirectResponse
     */
    public function handle(Request $request, Closure $next): RedirectResponse
    {
        $url = strip_tags($request->get('url'));
        $request->merge(
            [
                'url' => filter_var($url, FILTER_SANITIZE_URL),
            ]);

        return $next($request);
    }
}
