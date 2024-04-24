<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ManegerAndAdminRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role == 1 || auth()->user()->role == 2) {
            return $next($request);
        }
        return redirect()->route('indexUser');
    }
}
