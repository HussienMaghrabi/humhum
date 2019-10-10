<?php

namespace App\Http\Controllers\Website;


use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\City;
use App\Models\Order;
use App\Models\OrderCart;
use App\Models\Setting;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Validator;
use Auth;

class CityController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = City::orderBy('id')->get();
        $cities = City::pluck('name_'.App::getLocale(), 'id')->all();
        return view('website.views.cities.index',compact('data','cities'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resource['action'] = 'Create';

        return view('website.views.cities.index',compact( 'city'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $lang)
    {

        $auth = Auth::guard('web')->user();

        App::setLocale($lang);

        $rules = [
            'city_id' => 'required',
            'address' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            flashy()->error($validator->errors()->all()[0]);
            return back();
        }

        $input = $request->all();
        return view('website.views.payments.index',compact('input'));
    }


}
