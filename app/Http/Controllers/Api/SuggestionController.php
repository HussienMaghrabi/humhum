<?php

namespace App\Http\Controllers\Api;


use App\Admin;
use App\Category;
use App\City;
use App\Http\Controllers\Controller;
use App\Suggestion;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Validator;
use Auth;

class SuggestionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(){
        $data['suggestion'] = Suggestion::all();
        return $this->successResponse($data);
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $suggestion
     * @return \Illuminate\Http\Response
     */
     public function show($id){

        $data['suggestion'] = Suggestion::findOrFail($id);
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
             'phone' => 'required',
             'email' => 'required',
             'desc' => 'required',
         ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return $this->errorResponse($validator->errors()->all()[0]);
        }

        $data['suggestion'] = Suggestion::create($request->all());
         $message = __('dashboard.created');
        return $this->successResponse($data, $message);
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $suggestion
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request,$id){

         $rules =  [

             'name' => 'required',
             'phone' => 'required',
             'email' => 'required',
             'desc' => 'required',
         ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return $this->errorResponse($validator->errors()->all()[0]);
        }

        $data['suggestion'] = Suggestion::find($id);
        $data['suggestion']->update($request->all());
        $message = __('dashboard.updated');
        return $this->successResponse($data, $message);
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $suggestion
     * @return \Illuminate\Http\Response
     */
     public function destroy($id){

        $data = Suggestion::findOrFail($id);
        $data->delete();
        $message = __('dashboard.deleted');
        return $this->successResponse(null, $message);
     }
}
