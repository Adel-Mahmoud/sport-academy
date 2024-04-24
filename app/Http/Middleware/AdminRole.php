<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
          if (auth()->user()->role == 1) {
            return $next($request);
          }
        }
        return abort(403, 'Unauthorized');
    }
}
