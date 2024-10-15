<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // if (Auth::check() && User::where('id', Auth::id())->first()->isAdmin()) {
        //     return $next($request);
        // }
        if(in_array($request->user()->role, $roles)){
            return $next($request);
        }
        return redirect('/');
    }
}
