<?php

namespace Processton\Client\Middleware;

use Closure;
use Illuminate\Http\Request;
use Processton\Customer\Models\Customer;
use Symfony\Component\HttpFoundation\Response;

class CustomerMustHaveAddress
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $customer = request()->attributes->get('customer');

        if ($customer->addresses->count() <= 0) {
            return redirect()->route('client.set.address', [
                'ret_url' => $request->fullUrl(),
                'profile' => $request->route('profile')
            ]);
        }

        return $next($request);
    }
}
