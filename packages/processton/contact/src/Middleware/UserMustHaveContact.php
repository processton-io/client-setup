<?php

namespace Processton\Contact\Middleware;

use Closure;
use Illuminate\Http\Request;
use Processton\Contact\Models\Contact;
use Symfony\Component\HttpFoundation\Response;

class UserMustHaveContact
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Check if the user has a contact
        if ($request->user() && !$contact = $request->user()->contact) {
            // Auto create a contact for the user
            $contact = Contact::create([
                'first_name' => $request->user()->name,
                'last_name' => '',
                'email' => $request->user()->email,
                'phone' => '',
            ]);
        }

        // Append the contact to the request
        if ($contact) {
            $request->attributes->add(['contact' => $contact]);
        }

        return $next($request);
    }
}
