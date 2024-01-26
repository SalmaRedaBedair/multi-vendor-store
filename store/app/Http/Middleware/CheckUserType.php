<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$types): Response
    {
        $user=$request->user();
        if(!$user)
        {
            return redirect()->route('login');
        }

        if(!in_array($user->type, $types))
        {
            abort(403);
        }
        return $next($request); // that mean pass request to next step
        // when i request any page, it will call middlewares before go to controller
        // when it go to middleware it will pass request to next middlware then next middlware then next middlware ... untill it reach controller and padd it to it to
    }
}
