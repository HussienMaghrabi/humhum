<?php

namespace App\Http\Controllers\Website;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Validator;
use Auth;

class SaleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lang)
    {
        $data = Category::orderBy('sort')->get();

        return view('website.views.categories.index',compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $admin
     * @return \Illuminate\Http\Response
    //     */
//    public function show($lang, $id)
//    {
//        $data = SubCategory::where('category_id', $id)->paginate(10);
//        return view('website.views.categories.',compact('data'));
//    }

}
