<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Validator;
use Auth;

class SubCategoryController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $admin
     * @return \Illuminate\Http\Response
     */
    public function show($lang, $id)
    {
        $data = SubCategory::orderBy('sort')->where('category_id',$id)->get();

        return view('website.views.subcategories.index',compact('data'));
    }

}
