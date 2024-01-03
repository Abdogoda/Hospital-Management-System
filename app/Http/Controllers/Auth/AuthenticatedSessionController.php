<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller{

    public function create(): View{
        return view('Dashboard.User.auth.signin');
    }

    public function store(LoginRequest $request): RedirectResponse{
        if($request->authenticate()){
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        return redirect()->back()->withErrors(['name'=> (trans(("Dashboard/auth.failed")))]);
    }

    public function destroy(Request $request): RedirectResponse{
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}