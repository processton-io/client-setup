<?php

namespace Processton\Company\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMustHaveCompany
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if($request->user() && $request->user()->contact) {

            //Append the customer to the request
            $customer = $request->user()->contact->customers->first();

            if($request->user()->contact->customers->count() > 0){

                $request->attributes->add(['customer' => $customer]);

                return $next($request);
            }

        }

        return redirect()->route('processton-company.set.company')->with('error', 'You must have a company to access this page.')->withInput();

    }
}
