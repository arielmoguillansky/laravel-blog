<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminsOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // This works in case Gate is not defined in the AppProvideService. It can be removed if Gate is defined, removed from the Http\Kernel file and replace the middleware name in the routes file with can:admin.
        if(auth()->user()?->cannot('admin'))
        {
            abort(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
