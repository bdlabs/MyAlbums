<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class AlbumSanitizer
 *
 * @package App\Http\Middleware
 */
class AlbumSanitizer
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
        $request->merge(
            [
                'title' => filter_var($request->get('title'), FILTER_SANITIZE_STRING),
            ]);

        return $next($request);
    }
}
