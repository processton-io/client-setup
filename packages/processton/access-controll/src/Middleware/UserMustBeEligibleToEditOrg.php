<?php

namespace Processton\AccessControll\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMustBeEligibleToEditOrg
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if($request->user() && $request->user()->hasRole('Super Admin')){
            return $next($request);
        }
        abort(403, "You are not allowed to edit this organization.");

    }
}
