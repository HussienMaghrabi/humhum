<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\FcmToken;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Auth;


class AuthController extends Controller
{

    public function login()
    {
        $this->lang();
        $rules =  [
            'email'  => 'required',
            'password'  => 'required',
        ];


        $validator = Validator::make(request()->all(), $rules);
        if($validator->fails()) {
            return $this->errorResponse($validator->errors()->all()[0]);
        }

        if (Auth::guard('apiUser')->attempt(['email' => request('email'), 'password' => request('password')]))
        {
            $auth = Auth::guard('apiUser')->user();
            $token = str_random(70);
            Token::create(['api_token'=>$token, 'user_id' => $auth->id]);
            $fcm =FcmToken::where('fcm_token',request('fcm_token'))->first() ;
            if ($fcm){
                $fcm->update(['user_id' => $auth->id]);
            }else{
                FcmToken::create(['fcm_token'=>request('fcm_token'), 'user_id' => $auth->id]);
            }

            $data['user'] = User::where('id', $auth->id)->select('id', 'name', 'image', 'phone', 'email')->first();
            $data['user']->api_token = $token;


            return $this->successResponse($data,  __('api.RegisterSuccess'));
        }
        if (Auth::guard('apiUser')->attempt(['phone' => request('email'), 'password' => request('password')]))
        {
            $auth = Auth::guard('apiUser')->user();
            $token = str_random(70);
            Token::create(['api_token'=>$token, 'user_id' => $auth->id]);
            $fcm =FcmToken::where('fcm_token',request('fcm_token'))->first() ;
            if ($fcm){
                $fcm->update(['user_id' => $auth->id]);
            }else{
                FcmToken::create(['fcm_token'=>$token, 'user_id' => $auth->id]);
            }

            $data['user'] = User::where('id', $auth->id)->select('id', 'name', 'image', 'phone', 'email')->first();
            $data['user']->api_token = $token;

            return $this->successResponse($data,  __('api.RegisterSuccess'));
        }
        return $this->errorResponse(__('api.LoginFail'),null);
    }

    public function register()
    {
        $this->lang();
        $rules =  [
            'name'  => 'required',
            'phone'  => 'required|unique:users',
            'email'  => 'required|unique:users',
            'password'  => 'required',
            'image'  => 'nullable',
        ];

        $validator = Validator::make(request()->all(), $rules);
        $errors = $this->formatErrors($validator->errors());
        if($validator->fails()) {return $this->errorResponse($errors);}

        $input = request()->except('image','fcm_token');


        if (request('image'))
        {
            $input['image'] = $this->uploadBase64(request('image'), 'users');
        }

        $auth = User::create($input);
        $token = str_random(70);
        Token::create(['api_token' => $token, 'user_id' => $auth->id]);
        $fcm =FcmToken::where('fcm_token',request('fcm_token'))->first() ;
        if ($fcm){
            $fcm->update(['user_id' => $auth->id]);
        }else{
            FcmToken::create(['fcm_token'=>$token, 'user_id' => $auth->id]);
        }
        $data['user'] = User::where('id', $auth->id)->select('id', 'name', 'image', 'phone', 'email')->first();
        $data['user']->api_token = $token;

        return $this->successResponse($data, __('api.RegisterSuccess'));
    }

    public function logout()
    {
        $this->lang();
        $auth = $this->auth();
        User::find($auth)->update(['api_token' => null]);
        return $this->successResponse(null, __('api.Logout'));
    }


}
