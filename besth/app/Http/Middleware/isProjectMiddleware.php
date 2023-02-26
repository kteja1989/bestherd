<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class isProjectMiddleware
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
      	if (Auth::user()->hasAnyRole(['investigator','researcher','veterinarian']))
				{
							return $next($request);
				}
				else {
					     abort('401');
				}

    }
}
