<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Auth;

class ProfileController extends Controller
{
    private $resources = 'profile';
    private $resource = [
        'route' => 'vendor.profile',
        'view' => "profile",
        'icon' => "user",
        'title' => "PROFILE",
        'action' => "",
        'header' => "Profile"
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $item = Vendor::findOrFail(Auth::guard('vendor')->user()->id);
        $resource = $this->resource;
        $resource['action'] = 'Edit';
        return view('vendor.views.'.$this->resources.'.edit',compact('item', 'resource' ));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $lang, $id)
    {
        $rules =  [
            'password' => 'nullable|min:6',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            flashy()->error($validator->errors()->all()[0]);
            return back();
        }

        Vendor::find($id)->update($request->all());
        App::setLocale($lang);
        flashy(__('dashboard.updated'));
        return redirect()->route($this->resource['route'].'.index', $lang);
    }
}
