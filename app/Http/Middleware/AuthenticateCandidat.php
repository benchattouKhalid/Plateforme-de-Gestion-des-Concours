<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateCandidat
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('candidat')->check()) {
            return redirect()->route('login')->withErrors(['error' => 'Please log in to continue.']);
        }

        return $next($request);
    }
}
