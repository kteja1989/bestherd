<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class loginGateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->hasAnyRole([
                                        'admin',
                                        'manager',
                                        'pisg',
                                        'pilg',
                                        'piblg',
                                        'pient',
                                        'investigator',
                                        'researcher',
                                        'veterinarian',
                                        'facility_help',
                                        'herdmanager',
                                        'herdasstimmun',
                                        'herdasstserum',
                                        'herdvet'
		                            ]))
				{
            return $next($request);
        }
        else {
        	$users_without_any_roles = User::doesntHave('roles')->get();
        
        	foreach($users_without_any_roles as $val)
        	{
        		$noRoleUsers[] = $val->name;
        	}
        	    $us = Auth::user();
        
        	if(in_array($us->name, $noRoleUsers))
        	{
        		return redirect('/dashboard');
        	}
        	else {
        		abort('401');
        	}
        	abort('401');
        }
        
            //return $next($request);
            /*
            if (Auth::user()->hasRole(['admin', 'manager']))
            {
            return redirect()->route('home');
            }
            
            if (Auth::user()->hasRole(['investigator']))
            {
            return redirect()->route('home');
            }
            */
    }
}
