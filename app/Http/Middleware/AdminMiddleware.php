<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) 
        {
            /** @var App\Models\User */
            $user = Auth::user();
            if ($user->hasRole(['super-admin', 'admin','utilisateur'])) {
                return $next($request);
            }

            abort(403, 'Utilisateur does not have correct Role');
        }
        
        abort(401);
    }
}
