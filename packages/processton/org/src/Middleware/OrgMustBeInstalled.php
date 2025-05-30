<?php

namespace Processton\Org\Middleware;

use Closure;
use Illuminate\Http\Request;
use Processton\Org\Models\Org;
use Symfony\Component\HttpFoundation\Response;

class OrgMustBeInstalled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $orgSettings = Org::all();

        //Check if the org is installed
        if($orgSettings->count() <= 0){
            //Run Db Seeder
            $seeder = new \Processton\OrgDatabase\Seeders\OrgsSeeder();
            $seeder->run();

            $orgSettings = Org::all();
        }

        $orgSettingNames = $orgSettings->pluck('org_value', 'org_key');

        $request->attributes->add(['orgSettings' => $orgSettingNames]);

        return $next($request);

    }
}
