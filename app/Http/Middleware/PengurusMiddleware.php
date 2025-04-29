<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PengurusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == 'pengurus') {
            return $next($request);
        }

        return redirect('/dashboard')->withErrors(['msg' => 'Anda tidak memiliki akses ke halaman pengurus.']);
    }
    
    /**
     * Get the path the middleware should be assigned to.
     *
     * @return string|null
     */
    public function getPath()
    {
        return 'pengurus';
    }
    
}
