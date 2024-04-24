<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ManegerRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
          if (auth()->user()->role == 2) {
            return $next($request);
          }
        }
        return abort(403, 'Unauthorized'); 
    }
}
