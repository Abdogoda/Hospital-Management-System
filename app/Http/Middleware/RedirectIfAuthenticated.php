<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    // public function handle(Request $request, Closure $next, string ...$guards): Response
    // {
    //     $guards = empty($guards) ? [null] : $guards;

    //     foreach ($guards as $guard) {
    //         if (Auth::guard($guard)->check()) {
    //             return redirect(RouteServiceProvider::HOME);
    //         }
    //     }

    //     return $next($request);
    // }

    public function handle($request, Closure $next){
        if(auth('web')->check()){
            return redirect(RouteServiceProvider::HOME);
        }
        if(auth('patient')->check()){
            return redirect(RouteServiceProvider::PATIENT);
        }
        if(auth('doctor')->check()){
            return redirect(RouteServiceProvider::DOCTOR);
        }
        if(auth('ray_employee')->check()){
            return redirect(RouteServiceProvider::RAYEMPLOYEE);
        }
        if(auth('laboratory_employee')->check()){
            return redirect(RouteServiceProvider::LABORATORYEMPLOYEE);
        }
        if(auth('admin')->check()){
            return redirect(RouteServiceProvider::ADMIN);
        }
        return $next($request);
    }
}