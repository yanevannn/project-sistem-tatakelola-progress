<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $type): Response
    {
        $user = $request->user();

        if (!$user) {
            abort(403, 'Unauthorized');
        }

        // Logika untuk pengurus inti
        if ($type === 'pengurus-inti' && !$user->isPengurusInti()) {
            abort(403, 'Unauthorized: Only Pengurus Inti Allowed');
        }

        // Logika untuk pengurus
        if ($type === 'pengurus' && !$user->isPengurus()) {
            abort(403, 'Unauthorized: Only Pengurus Allowed');
        }
        
        return $next($request);
    }
}
