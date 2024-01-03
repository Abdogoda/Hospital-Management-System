<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LaboratoryEmployeeLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaboratoryEmployeeController extends Controller{
    public function store(LaboratoryEmployeeLoginRequest $request){
        if($request->authenticate()){
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::RAYEMPLOYEE);
        }
        return redirect()->back()->withErrors(['name'=> (trans(("Dashboard/auth.failed")))]);
    }

    public function destroy(Request $request){
        Auth::guard('laboratory_employee')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}