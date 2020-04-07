<?php


namespace App\Http\Middleware;

use Closure;
use Fideloper\Proxy\TrustProxies as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteAdmin extends Middleware
{
    public function handle(Request $request, Closure $next)
    {

        if (!auth()->user()->hasRole('ROLE_SITE_ADMIN')) {
            Auth::logout();
            abort('403', 'UNAUTHORIZED ACCESS!');
        }

        return $next($request);
    }

}
