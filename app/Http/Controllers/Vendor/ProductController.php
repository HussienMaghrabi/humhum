<?php

namespace App\Http\Controllers\vendor;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Validator;
use Auth;

class ProductController extends Controller
{
    private $resources = 'products';
    private $resource = [
        'route' => 'vendor.products',
        'view' => "products",
        'icon' => "product-hunt",
        'title' => "PRODUCTS",
        'action' => "",
        'header' => "Products"
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::where('vendor_id',Auth::guard('vendor')->user()->id)->orderBy('id', 'DESC')->paginate(10);
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
        $city = City::pluck('name_'.App::getLocale(), 'id')->all();
        $categories = Category::select("name_$lang as name", 'id')->get();
        $subcat = SubCategory::select("name_$lang as name", 'id')->get();
        return view('vendor.views.'.$this->resources.'.create',compact( 'resource', 'city', 'subcat','categories'))->render();

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
            'name_ar' => 'required',
            'name_en' => 'required',
            'desc_ar' => 'required',
            'desc_en' => 'required',
            'price_before' => 'required',
            'price_after' => 'required',
            'image'   => 'required',


        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            flashy()->error($validator->errors()->all()[0]);
            return back();
        }

        $inputs = $request->except('image', 'images');
        $inputs['vendor_id'] = Auth::guard('vendor')->user()->id ;
        $inputs['city_id'] = Auth::guard('vendor')->user()->city_id ;

        if ($request->image)
        {
            $inputs['image'] =$this->uploadFile($request->image, 'product');
        }
        $item = Product::create($inputs);

        if ($request->images)
            foreach ($request->images as $image) {
                ProductImage::create([
                    'image' => $this->uploadFile($image, 'product'),
                    'product_id' => $item->id
                ]);
            }

        App::setLocale($lang);
        flashy(__('dashboard.created'));
        return redirect()->route($this->resource['route'].'.index', $lang);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vendor_product  $admin
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
        $item = Product::findOrFail($id);
        $city = City::pluck('name_'.App::getLocale(), 'id')->all();
        $categories = Category::select("name_$lang as name", 'id')->get();
        $subcat = SubCategory::select("name_$lang as name", 'id')->where('category_id', $item->scategory_id)->get();
        return view('vendor.views.' .$this->resources. '.edit', compact('item', 'resource','city','subcat','categories'));
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

            'name_ar' => 'required',
            'name_en' => 'required',
            'desc_ar' => 'required',
            'desc_en' => 'required',
            'price_before' => 'required',
            'price_after' => 'required',
            'image'   =>  'nullable',

        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            flashy()->error($validator->errors()->all()[0]);
            return back();
        }

        $inputs = $request->except('image');
        $item = product::findOrFail($id);
        if ($request->image)
        {
            if (strpos($item->image, '/uploads/') !== false) {
                $image = str_replace( asset('').'storage/', '', $item->image);
                Storage::disk('public')->delete($image);
            }
            $inputs['image'] =$this->uploadFile($request->image, 'product');
        }

        product::find($id)->update($inputs);
        App::setLocale($lang);
        flashy(__('dashboard.updated'));
        return redirect()->route($this->resource['route'].'.index', $lang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vendor_product  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, $id)
    {
        $item = Product::findOrFail($id);
        if (strpos($item->image, '/uploads/') !== false) {
            $image = str_replace( asset('').'storage/', '', $item->image);
            Storage::disk('public')->delete($image);
        }
        $item->delete();

        App::setLocale($lang);
        flashy(__('dashboard.deleted'));
        return redirect()->route($this->resource['route'].'.index', $lang);
    }

    public function multiDelete($lang)
    {
        foreach (\request('checked') as $id)
        {
            $item = Product::findOrFail($id);
            if (strpos($item->image, '/uploads/') !== false) {
                $image = str_replace( asset('').'storage/', '', $item->image);
                Storage::disk('public')->delete($image);
            }
            $item->delete();
        }
        App::setLocale($lang);
        flashy(__('dashboard.deleted'));
        return redirect()->route($this->resource['route'].'.index', $lang);
    }

    public function search(Request $request, $lang)
    {
        $resource = $this->resource;
        $data = product::where('name_ar', 'LIKE', '%'.$request->text.'%')
            ->orWhere('name_en', 'LIKE', '%'.$request->text.'%')
            ->paginate(10);
        App::setLocale($lang);
        return view('store.views.' .$this->resources. '.index', compact('data', 'resource'));
    }

    public function ajax($lang){
        if(request('category_id')) {
            $category = SubCategory::select("name_$lang as name", 'id')->where('category_id', request('category_id'))->get();
            return view('dashboard.views.offers.sub', compact('category'))->render();
        }elseif(request('sub_category')) {
            $subsubcat = SubSubCategory::select("name_$lang as name", 'id')->where('sub_category_id', request('sub_category'))->get();

                $data['view'] = view('dashboard.views.offers.sub', compact('subsubcat'))->render();
                $data['type'] = 2;
                return response()->json($data);

        }
    }


}
