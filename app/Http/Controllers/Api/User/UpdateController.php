<?php

namespace App\Http\Controllers\Api\User;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Validator;
use Auth;

class UpdateController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lang = $this->lang();
        $auth = $this->auth();

        $data['user'] = User::where('id', $auth)->select(
            'id',
            'name',
            'image',
            'phone',
            'email')->first();

        return $this->successResponse($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
     public function show($id){

        $data['user'] = User::findOrFail($id);
        return $this->successResponse($data);
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function create(Request $request){

        $rules =  [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'min:6',
            'image' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return $this->errorResponse($validator->errors()->all()[0]);
        }

        $input = $request->except('image');
        $input['api_token'] = str_random(60);
        if( $request->image) {
            $input['image'] = $this->uploadBase64($request['image']);
        }
        $data['user'] = User::create($input);

        return $this->successResponse($data);
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $this->lang();
        $auth = $this->auth();
        $rules =  [
            'name'  => 'required',
            'phone'  => 'required|unique:users,phone,'.$auth,
            'email'  => 'required|unique:users,email,'.$auth,
            'image'  => 'nullable',
        ];

        $validator = Validator::make(request()->all(), $rules);
        $errors = $this->formatErrors($validator->errors());
        if($validator->fails()) return $this->errorResponse($errors);

        $input = request()->except('image');
        $item = User::find($auth);

        if (request('image'))
        {
            if (strpos($item->image, '/uploads/') !== false) {
                $image = str_replace( asset('').'storage/', '', $item->image);
                Storage::disk('public')->delete($image);
            }
            $input['image'] = $this->uploadBase64(request('image'), 'users/'.$auth);
        }
        $item->update($input);

        $data['user'] = User::where('id', $auth)->select('id', 'name', 'image', 'phone', 'email')->first();
        $data['user']->api_toekn = request()->header('Authorization');

        return $this->successResponse($data, __('api.ProfileUpdated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
     public function destroy($id){

        $data = User::findOrFail($id);
        if($data->image){
            $path = parse_url($data->image);
            unlink(public_path($path['path']));
        }
        $data->delete();
        $message = __('dashboard.deleted');
        return $this->successResponse(null, $message);
     }
}
