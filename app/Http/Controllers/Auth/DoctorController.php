<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;


class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function store(Request $request)
    {

        if(Auth::attempt($request->only('name', 'password'))){

            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::DOCTOR);
        }
        toastr()->error('عذراً لا يمكنك الدخول يرجى التأكد من صحة البيانات المدخلة والمحاولة مرةً اخرى');
        return redirect()->back();
    } 

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
