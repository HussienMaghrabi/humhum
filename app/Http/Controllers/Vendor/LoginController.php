<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{

    public function index(){
        if (Auth::guard('vendor')->check())
        {
            return redirect('ar/store');
        }
        return view('vendor.login');
    }

    public function login(Request $request)
    {
        if (Auth::guard('vendor')->attempt(['email'=>$request->email, 'password'=>$request->password])){
            return redirect('ar/store');
        }
        flashy()->error(__('dashboard.login_fail'));
        return back();
    }

    public function logout(Request $request)
    {
        Auth::guard('vendor')->logout();

        return redirect(route('vendor.login'));
    }
}
