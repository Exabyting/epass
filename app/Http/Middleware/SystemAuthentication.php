<?php


namespace App\Http\Middleware;

use Closure;
use Fideloper\Proxy\TrustProxies as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SystemAuthentication extends Middleware
{
    public function handle(Request $request, Closure $next)
    {
        list($is_shutdown, $is_special, $is_super_admin) = $this->findFlagValues();

        if ($is_shutdown && !$is_special && !$is_super_admin) {
//            Auth::logout();
            abort('418', config('constants.shutdown_message'));
            return redirect()->route('shutdown.message');

        }

        return $next($request);
    }

    /**
     * @return array
     */
    private function findFlagValues(): array
    {
        $shutdown = DB::table('admin')->where('key', 'shutdown')->first();
        $special = DB::table('admin')->where('key', 'special')->first();

        $is_shutdown = optional($shutdown)->value == 1 ? true : false;

        $is_special_on = optional($special)->value == 1 ? true : false;

//        $is_special = optional(auth()->user())->hasRole('ROLE_SPECIAL_ACCESS') == 1 && $is_special_on ? true : false;

        $is_special = optional(auth()->user())->hasRole('ROLE_SPECIAL_ACCESS') == 1 ? true : false;

        $is_super_admin = optional(auth()->user())->hasRole('ROLE_SUPER_ADMIN') ? true : false;

        return array($is_shutdown, $is_special, $is_super_admin);
    }
}
