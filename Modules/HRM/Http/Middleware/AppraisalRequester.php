<?php

namespace Modules\HRM\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AppraisalRequester
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $appraisalRequest = $request->appraisalRequest;

        if ($appraisalRequest->requester->user->id != auth()->user()->id){
            Session::flash('error', 'Access Denied');
            return redirect()->route('appraisal-request.index');
        }

        return $next($request);
    }
}
