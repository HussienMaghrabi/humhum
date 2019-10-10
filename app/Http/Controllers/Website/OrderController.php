<?php

namespace App\Http\Controllers\Website;

use App\Models\Cart;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Validator;
use Auth;

class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lang)
    {
        $data = Order::orderBy('id')->paginate(10);
        return view('website.views.orders.index',compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $admin
     * @return \Illuminate\Http\Response
//     */
//    public function show($lang, $id)
//    {
//        $data = SubCategory::where('category_id', $id)->paginate(10);
//        return view('website.views.categories.',compact('data'));
//    }

}
