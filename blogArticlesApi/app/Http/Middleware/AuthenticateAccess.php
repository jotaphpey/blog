<?php

namespace App\Http\Middleware;

use Closure;
use Zend\Diactoros\Response;
use Illuminate\Http\Response as ResponseHttp;

class AuthenticateAccess
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
        $validSecret = explode(',', env('ACCEPTED_SECRETS'));

        if(in_array($request->header('Authorization'), $validSecret)){
            return $next($request);
        }

        abort(ResponseHttp::HTTP_UNAUTHORIZED);
    }
}
