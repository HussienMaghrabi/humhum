<?php

namespace App\Http\Controllers\Api;


use App\Admin;
use App\Category;
use App\City;
use App\Http\Controllers\Controller;
use App\Region;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Validator;
use Auth;

class RegionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(){
         $lang = request()->header('lang');
         $data['region'] = Region::select("id", "name_$lang as name")->get();
         return $this->successResponse($data);
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $region
     * @return \Illuminate\Http\Response
     */
     public function show($id){
         $lang = request()->header('lang');
         $data['city'] = Region::where('id', $id)->select(
             "name_$lang as name"
         )->first();
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

             'name_ar' => 'required',
             'name_en' => 'required',
         ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return $this->errorResponse($validator->errors()->all()[0]);
        }

        $data['region'] = Region::create($request->all());
         $message = __('dashboard.created');
        return $this->successResponse($data, $message);
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $region
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request,$id){

         $rules =  [

             'name_ar' => 'required',
             'name_en' => 'required',
         ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return $this->errorResponse($validator->errors()->all()[0]);
        }

        $data['region'] = Region::find($id);
        $data['region']->update($request->all());
        $message = __('dashboard.updated');
        return $this->successResponse($data, $message);
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $region
     * @return \Illuminate\Http\Response
     */
     public function destroy($id){

        $data = Region::findOrFail($id);
        $data->delete();
        $message = __('dashboard.deleted');
        return $this->successResponse(null, $message);
     }
}
