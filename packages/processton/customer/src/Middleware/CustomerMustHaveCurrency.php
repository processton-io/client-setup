<?php

namespace Processton\Customer\Middleware;

use Closure;
use Illuminate\Http\Request;
use Processton\Customer\Models\Customer;
use Symfony\Component\HttpFoundation\Response;

class CustomerMustHaveCurrency
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $customer = request()->attributes->get('customer');

        if($customer->currency_id) {
            return $next($request);
        }

        return redirect()->route('client.set.currency', ['profile' => $request->route('profile')])->with('error', 'You must have a company to access this page.')->withInput();
    }
}
