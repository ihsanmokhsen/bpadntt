<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureActiveAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        abort_unless(
            $request->user()?->is_active && $request->user()->role === 'admin',
            Response::HTTP_FORBIDDEN,
        );

        return $next($request);
    }
}
