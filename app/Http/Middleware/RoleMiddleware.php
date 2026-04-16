<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        if(!Auth::check()){
            if($request->expectsJson()){
            return response()->json(['message'=>'Unauthenticated'],401);
            }
            return redirect()->route('login');
        }
        // Convert comma-separated string to array
        $roles = is_array($roles) ? $roles : explode('|', $roles);

        if(!in_array(Auth::user()->role,$roles)){
            if($request->expectsJson()){
            return response()->json(['message'=>'Forbidden'],403);
            }
            return abort(403);
        }
        return $next($request);
    }
}
