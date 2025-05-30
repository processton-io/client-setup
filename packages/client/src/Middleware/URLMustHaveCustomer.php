<?php

namespace Processton\Client\Middleware;

use Closure;
use Illuminate\Http\Request;
use Processton\Customer\Models\Customer;
use Symfony\Component\HttpFoundation\Response;

class URLMustHaveCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if($request->route('profile')) {


            $customer = Customer::where('id', $request->route('profile'))->first();

            if ($customer == null) {
                abort(404);
            }

            //Append to the request
            $request->attributes->add([
                'customer' => $customer,
            ]);

            return $next($request);
        }

        abort(404);
    }
}
