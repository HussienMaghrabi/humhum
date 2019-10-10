<?php

namespace App\Http\Controllers\Website;

use App\Models\Cart;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\StorePrice;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Validator;
use Auth;

class ProductController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $admin
     * @return \Illuminate\Http\Response
     */
    public function show($lang, $id, $type)
    {
        if($type == "subcategories"){
            $data = Product::orderBy('id')
                    ->where('sub_category_id',$id)->get();
            $title = SubCategory::find($id);
            $title = $title["name_$lang"];
            return view('website.views.products.index',compact('data','title'));
        }
        $data = Product::orderBy('id')
            ->where('sub_sub_category_id',$id)->get();
        $title = SubSubCategory::find($id);
        $title = $title["name_$lang"];
        return view('website.views.products.index',compact('data','title'));
    }

    public function details($lang, $id)
    {
        $data = Product::orderBy('id')->where('id',$id)->first();
        $image = ProductImage::orderBy('id')->where('product_id',$id)->get();
        return view('website.views.products.show',compact('data','image'));
    }

}
