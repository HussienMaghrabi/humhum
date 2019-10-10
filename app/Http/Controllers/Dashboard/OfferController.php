<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use App\Models\City;
use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Product;
use App\Models\StorePrice;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Validator;
use Auth;

class OfferController extends Controller
{
    private $resources = 'offers';

    private $resource = [
        'route' => 'admin.offers',
        'view' => "offers",
        'icon' => "usd",
        'title' => "OFFERS",
        'action' => "",
        'header' => "Offers"
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($lang)
    {
        $data = Offer::orderBy('id')->paginate(10);
        $resource = $this->resource;
        return view('dashboard.views.'.$this->resources.'.index',compact('data', 'resource'));
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
        return view('dashboard.views.'.$this->resources.'.create',compact( 'resource', 'subcat','categories'));

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

            'cost' => 'required',
            'maximum' => 'required',
            'start' => 'required',
            'end' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            flashy()->error($validator->errors()->all()[0]);
            return back();
        }

        $product = StorePrice::find(request('product_id'));
        $vat = round(($product->price_before * request('cost')/100), 2);

        $item = Offer::create($request->except('sub_category_id','sub_sub_category_id','category_id','vat'));
        $product->update(['price_after'=>$product->price_before - $vat  ]);
        App::setLocale($lang);

        $date = date(Carbon::now()->format('d-m-Y'));

        if(request()->start >= $date){

            $name =$item->Product->name_ar;
            $title = 'عرض جديد';
            $body = "خصم علي $name بقيمة $item->cost %";
            $id = $item->id;
            $this->broadCastNotification($title,$body,$id);
            flashy(__('dashboard.created'));
            return redirect()->route($this->resource['route'].'.index', $lang);

        } else{

            return redirect()->route($this->resource['route'].'.index', $lang);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $admin
     * @return \Illuminate\Http\Response
     */

    public function show($lang, $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $admin
     * @return \Illuminate\Http\Response
     */

    public function edit($lang, $id)
    {
        $resource = $this->resource;
        $resource['action'] = 'Edit';
        $item = Offer::findOrFail($id);
        return view('dashboard.views.' .$this->resources. '.edit', compact('item', 'resource'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $admin
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $lang, $id)
    {
        $rules =  [
            'cost' => 'required',
            'maximum' => 'required',
            'start' => 'required',
            'end' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            flashy()->error($validator->errors()->all()[0]);
            return back();
        }


        $item = StorePrice::where('product_id', request('product_id'))->first();
        $vat = round(($item->price_before * request('cost')/100), 2);
        $item->update($request->all());
        $item->update([
            'price_after'=>$item->price_before - $vat ,
            ]);
        App::setLocale($lang);
        flashy(__('dashboard.updated'));
        return redirect()->route($this->resource['route'].'.index', $lang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $admin
     * @return \Illuminate\Http\Response
     */

    public function destroy($lang, $id)
    {
        Offer::findOrFail($id)->delete();
        App::setLocale($lang);
        flashy(__('dashboard.deleted'));
        return redirect()->route($this->resource['route'].'.index', $lang);
    }

    public function multiDelete($lang)
    {
        foreach (\request('checked') as $id)
        {
            Offer::findOrFail($id)->delete();
        }
        App::setLocale($lang);
        flashy(__('dashboard.deleted'));
        return redirect()->route($this->resource['route'].'.index', $lang);
    }

    public function search(Request $request, $lang)
    {
        $resource = $this->resource;
        $data = Offer::where('name_ar', 'LIKE', '%'.$request->text.'%')
            ->orWhere('name_en', 'LIKE', '%'.$request->text.'%')
            ->paginate(10);
        App::setLocale($lang);
        return view('dashboard.views.' .$this->resources. '.index', compact('data', 'resource'));
    }

    public function ajax($lang){
        if(request('category_id')) {
            $category = SubCategory::select("name_$lang as name", 'id')->where('category_id', request('category_id'))->get();
            return view('dashboard.views.offers.sub', compact('category'))->render();
        }elseif(request('sub_category')) {
            $subsubcat = SubSubCategory::select("name_$lang as name", 'id')->where('sub_category_id', request('sub_category'))->get();
            if (count($subsubcat) > 0) {
                $data['view'] = view('dashboard.views.offers.sub', compact('subsubcat'))->render();
                $data['type'] = 2;
                return response()->json($data);
            }else {
                $products = Product::select("name_$lang as name", 'id')->where('sub_category_id', request('sub_category'))->get();
                $data['view'] = view('dashboard.views.offers.sub', compact('products'))->render();
                $data['type'] = 1;
                return response()->json($data);
            }
        }else {
            $products = Product::select("name_$lang as name", 'id')->where('sub_sub_category_id', request('sub_sub_category'))->get();
            return view('dashboard.views.offers.sub', compact('products'));
        }
    }

    public function ok(){
        $item = Offer::where('product_id',request('product_id'))->first();
        if ($item){
            return 1 ;
        }
        return 0 ;
    }

    public function up($lang){
        $item = Offer::where('product_id',request('product_id'))->first();

        $item->update([
            'cost'=>request('cost')
        ]);
        $product = StorePrice::find(request('product_id'));
        $vat = round(($product->price_before * request('cost')/100), 2);
        $product->update(['price_after'=>$product->price_before - $vat  ]);
        App::setLocale($lang);
        flashy(__('dashboard.updated'));

        $name =$item->Product->name_ar;
        $title = 'عرض جديد';
        $body = "خصم علي $name بقيمة $item->cost %";
        $id = $item->id;
        $this->broadCastNotification($title,$body,$id);

        return redirect()->route($this->resource['route'].'.index', $lang);
    }
}
