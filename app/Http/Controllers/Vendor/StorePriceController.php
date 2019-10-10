<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\StorePrice;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Validator;
use Auth;

class StorePriceController extends Controller
{
    private $resources = 'prices';
    private $resource = [
        'route' => 'vendor.price',
        'view' => "prices",
        'icon' => "bookmark",
        'title' => "PRICES",
        'action' => "",
        'header' => "Prices"
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = StorePrice::orderBy('id', 'DESC')->paginate(10);
        $resource = $this->resource;
        return view('vendor.views.'.$this->resources.'.index',compact('data', 'resource'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($lang)
    {
        $resource = $this->resource;
        $resource['action'] = 'Create';
        $categories = Category::select("name_$lang as name", 'id')->get();
        $subcat = SubCategory::select("name_$lang as name", 'id')->get();
        return view('vendor.views.'.$this->resources.'.create',compact( 'resource',  'subcat','categories'))->render();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $lang)
    {
        $rules =  [

            'price_before' => 'required',
            'price_after' => 'required',



        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            flashy()->error($validator->errors()->all()[0]);
            return back();
        }

        $inputs = $request->all();
        $inputs['vendor_id'] = Auth::guard('vendor')->user()->id ;
        $inputs['city_id'] = Auth::guard('vendor')->user()->city_id ;

        StorePrice::create($inputs);


        App::setLocale($lang);
        flashy(__('dashboard.created'));
        return redirect()->route($this->resource['route'].'.index', $lang);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubSubCategory  $admin
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vendor_product  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($lang, $id)
    {
        $resource = $this->resource;
        $resource['action'] = 'Edit';
        $item = StorePrice::findOrFail($id);
        return view('vendor.views.' .$this->resources. '.edit', compact('item', 'resource'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vendor_product  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $lang, $id)
    {
        $rules =  [
            'price_before' => 'required',
            'price_after' => 'required',

        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            flashy()->error($validator->errors()->all()[0]);
            return back();
        }

        $inputs = $request->all();


        StorePrice::find($id)->update($inputs);
        App::setLocale($lang);
        flashy(__('dashboard.updated'));
        return redirect()->route($this->resource['route'].'.index', $lang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubSubCategory  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, $id)
    {
        $item = StorePrice::findOrFail($id);
        $item->delete();
        App::setLocale($lang);
        flashy(__('dashboard.deleted'));
        return redirect()->route($this->resource['route'].'.index', $lang);
    }

    public function multiDelete($lang)
    {
        foreach (\request('checked') as $id)
        {
            $item = StorePrice::findOrFail($id);
            $item->delete();

        }
        App::setLocale($lang);
        flashy(__('dashboard.deleted'));
        return redirect()->route($this->resource['route'].'.index', $lang);
    }

    public function search($lang, Request $request, $value)
    {
       //

    }

    public function ajax($lang){
        if(request('category_id')) {
            $category = SubCategory::select("name_$lang as name", 'id')->where('category_id', request('category_id'))->get();
            return view('vendor.views.prices.sub', compact('category'))->render();
        }elseif(request('sub_category')) {
            $subsubcat = SubSubCategory::select("name_$lang as name", 'id')->where('sub_category_id', request('sub_category'))->get();
            if (count($subsubcat) > 0) {
                $data['view'] = view('vendor.views.prices.sub', compact('subsubcat'))->render();
                $data['type'] = 2;
                return response()->json($data);
            }else {
                $products = Product::select("name_$lang as name", 'id')->where('sub_category_id', request('sub_category'))->get();
                $data['view'] = view('vendor.views.prices.sub', compact('products'))->render();
                $data['type'] = 1;
                return response()->json($data);
            }
        }else {
            $products = Product::select("name_$lang as name", 'id')->where('sub_sub_category_id', request('sub_sub_category'))->get();
            return view('vendor.views.prices.sub', compact('products'));
        }
    }
}
