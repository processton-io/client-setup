<?php

namespace Processton\Org\Middleware;

use Closure;
use Illuminate\Http\Request;
use Processton\Org\Models\Org;
use Symfony\Component\HttpFoundation\Response;

class OrgMustHaveFinancialProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $orgSettings = $request->attributes->get('orgSettings');

        $requiredFields = [
            'tax_id',
            'primary_currency',
            'financial_calendar'
        ];

        $orgSettings = $orgSettings->filter(function ($value, $key) use ($requiredFields) {
            return in_array($key, $requiredFields) && $value == null;
        });

        //Check if the org is installed
        if($orgSettings->count() <= 0){

            return $next($request);

        }

        return redirect()->route('processton-org.set-financial-org', [
            'ret_url' => $request->fullUrl()
        ])->with('error', 'You must have an org setup.')->withInput();

    }
}
