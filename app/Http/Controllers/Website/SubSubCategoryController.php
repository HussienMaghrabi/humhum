<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Validator;
use Auth;

class SubSubCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lang)
    {
        $data = SubSubCategory::orderBy('sort')->paginate(10);
        return view('website.views.sub2categories.index',compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category $admin
     * @return \Illuminate\Http\Response
     */
    public function show($lang, $id)
    {
        $data = SubSubCategory::orderBy('sort')->where('sub_category_id',$id)->get();
        $subcategory = SubCategory::orderBy('sort')->where('id',$id)->get();
        return view('website.views.sub2categories.index',compact('data','subcategory'));
    }

}
