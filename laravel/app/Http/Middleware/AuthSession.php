<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthSession
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('authenticated')) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado.');
        }

        return $next($request);
    }
}
