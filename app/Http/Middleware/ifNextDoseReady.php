<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ifNextDoseReady
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
        if($request->user()->ifHasPendingSchedule()) {
            return abort(401);
        }
        else if($request->user()->getNextBakuna() == 'FINISHED') {
            return abort(401);
        }
        else if($request->ifNextDoseReady()) {
            return $next($request);
        }
        else {
            return abort(401);
        }        
    }
}
