<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $api_token=$request->header('x-api-key');
        if($api_token !== config('app.api_token'))
        {
            return \Illuminate\Support\Facades\Response::json([
                'message'=>'Invalid Api Token'
            ],400);
        }
        return $next($request);
    }
}
