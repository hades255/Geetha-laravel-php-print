<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Stancl\Tenancy\Facades\Tenancy;
use App\Tenant;

class SetTenantContext
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $subdomain = explode('.', $request->getHost())[0];

        $tenant = Tenant::where('id', $subdomain)->first();
        
        if(!empty($tenant)){
           Tenancy::initialize($tenant); 
        }
        
        

        return $next($request);
    }
}
