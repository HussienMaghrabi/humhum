<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{

    public function index(){

//        if (Auth::guard('web')->check())
//        {
//            return redirect('/ar');
//        }
        return view('website.views.auth.index');
    }

    public function login(Request $request)
    {

        if (Auth::guard('web')->attempt(['email'=>$request->email, 'password'=>$request->password])){
            return redirect('/ar');
        }
        flashy()->error(__('dashboard.login_fail'));
        return back();
    }

    public function register(Request $request)
    {

        $rules =  [
            'remember'      => 'required',
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'phone'     => 'required|unique:users',
            'password'  => 'required|confirmed|min:6',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            flashy()->error($validator->errors()->all()[0]);
            return back();
        }

        $user = User::create($request->except('password_confirmation', 'url', 'remember'));
        $user->save();
        Auth::login($user);

        return redirect(\request('url'));
    }

    public function postForgetPassword(Request $request)
    {
        $rules =  [
            'email' => 'exists:users,email',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            flashy()->error($validator->errors()->all()[0]);
            return back();
        }

        Password::broker()->sendResetLink(
            $request->only('email')
        );

        flashy(__('apiMessages.successForgetPasswordMail'));

        return back();
    }
}
