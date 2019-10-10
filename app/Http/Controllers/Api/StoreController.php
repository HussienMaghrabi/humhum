<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Image;
use App\License;
use App\Store;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Validator;
use Auth;

class StoreController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lang = request()->header('lang');
        $data['store'] = Store::select(
            "name_$lang as name",
            'category_id',
            'city_id',
            'email',
            'image',
            'phone',
            "address_$lang as address",
            'bank',
            'account'
        )->get();
        $data['store']->map(function ($item) use ($lang) {
            $item->category_name = $item->category["name_$lang"];
            $item->city_name = $item->city["name_$lang"];

            unset($item->category);
            unset($item->city);
            unset($item->category_id);
            unset($item->city_id);
        });
        return $this->successResponse($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendor $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lang = request()->header('lang');
        $data['store'] = Store::where('id', $id)->select(
            "name_$lang as name",
            'category_id',
            'city_id',
            'email',
            'image',
            'phone',
            'bank',
            "address_$lang as address",
            'account'
        )->first();

        $data['store']->category_name = $data['store']->category["name_$lang"];
        $data['store']->city_name = $data['store']->city["name_$lang"];

        unset($data['store']->category);
        unset($data['store']->city);
        unset($data['store']->category_id);
        unset($data['store']->city_id);


        return $this->successResponse($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $rules = [
            'name'  => 'required',
            'phone'  => 'required|unique:stores',
            'email'  => 'required|unique:stores',
            'password'  => 'required',
            'image'  => 'nullable',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->all()[0]);
        }

        $input = $request->except('name', 'address', 'image', 'images', 'licenses');

        $input['api_token'] = str_random(60);
        $input['name_ar'] = $request->name;
        $input['name_en'] = $request->name;
        $input['address_ar'] = $request->address;
        $input['address_en'] = $request->address;


        if ($request->image) {
            $input['image'] = $this->uploadBase64($request['image']);
        }


        $data['store'] = Store::create($input);

        if( $request->images){

                Image::create([
                    'image' => $this->uploadBase64($request['images']),
                    'store_id' => $data['store']->id,
                ]);
        }

        if ($request->licenses) {
            License::create([
                'image' => $this->uploadBase64($request['image']),
                'store_id' => $data['store']->id,
            ]);
        }

        return $this->successResponse($data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Vendor $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $rules = [
            'category_id' => 'required',
            'city_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'bank' => 'required',
            'account' => 'required',
            'address' => 'required',
            'minimum' => 'required',
            'active' => 'required',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->all()[0]);
        }
        $data = Store::findOrFail($id);
        $input = $request->except('name', 'address', 'image', 'images', 'licenses');

        if( $request->image) {
            $user = Store::findOrFail($id);
            $path = parse_url($user->image);
            unlink(public_path($path['path']));

            $input['image'] = $this->uploadBase64($request['image']);
        }
        if( $request->images){

            Image::create([
                'image' => $this->uploadBase64($request['images']),
                'store_id' =>$id
            ]);
        }

        if ($request->licenses) {

            License::create([
                'image' => $this->uploadBase64($request['image']),
                'store_id' =>$id
            ]);
        }
        $data['store'] = Store::find($id);
        $data['store']->update($input);

        $message = __('dashboard.updated');
        return $this->successResponse($data, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $data = Store::findOrFail($id);
        if ($data->image) {
            $path = parse_url($data->image);
            public_path($path['path']);
        }
        $data->delete();
        $message = __('dashboard.deleted');
        return $this->successResponse(null, $message);
    }
}
