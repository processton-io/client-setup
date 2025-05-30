<?php

namespace Processton\Locale\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMustHaveAddress
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if($request->user()->address_id == null) {
            return redirect()->route('locale.set.address',[
                'ret_url' => $request->fullUrl()
            ]);
        }

        return $next($request);
    }
}
