<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use App\Helpers\Acl;

class CheckRole
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
        $allow = Acl::getPermissions(
            $request->user()->user_type,
            $request->getPathInfo()
        );

        if (!$allow["success"]) {
            return new Response(view('unauthorized')->with('role', implode(",", $allow["rolesAllowed"])));
        }

        return $next($request);
    }
}
