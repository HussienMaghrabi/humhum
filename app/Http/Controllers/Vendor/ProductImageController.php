<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Product;
use App\Models\ProductImage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


use Auth;

class ProductImageController extends Controller
{
    private $resources = 'productImages';
    private $resource = [
        'route' => 'vendor.productImages',
        'view' => "productImages",
        'icon' => "picture-o",
        'title' => "PRODUCTIMAGES",
        'action' => "",
        'header' => "ProductImages",
        'return' => "vendor.products"
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lang, $value)
    {
        App::setLocale($lang);
        $data = ProductImage::where('product_id', $value)->paginate(10);
        $resource = $this->resource;
        return view('vendor.views.'.$this->resources.'.index',compact('data', 'resource', 'value'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($lang, $value)
    {
        App::setLocale($lang);
        $resource = $this->resource;
        $resource['action'] = 'Create';
        return view('vendor.views.'.$this->resources.'.create',compact( 'resource', 'value'));

    }

    public function store(Request $request, $lang, $value)
    {
        App::setLocale($lang);
        $rules =  [
            'image' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            flashy()->error($validator->errors()->all()[0]);
            return back();
        }

         $inputs=$this->uploadFile($request->image, 'users');

        ProductImage::create(['image'=>$inputs,'product_id'=>$value]);

        flashy(__('dashboard.created'));
        return redirect()->route($this->resource['route'].'.index', [$lang, $value]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($lang, $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($lang, $value, $id)
    {
        App::setLocale($lang);
        $resource = $this->resource;
        $resource['action'] = 'Edit';
        $item = ProductImage::findOrFail($id);
        return view('vendor.views.' .$this->resources. '.edit', compact('item', 'resource', 'value'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $lang, $value, $id)
    {
        App::setLocale($lang);
        $rules =  [
            'image' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            flashy()->error($validator->errors()->all()[0]);
            return back();
        }
        $item = ProductImage::find($id);
        $inputs = $request->except('image');
        if (strpos($item->image, '/uploads/') !== false) {
            $image = str_replace( asset('').'storage/', '', $item->image);
            Storage::disk('public')->delete($image);
        }
        $inputs['image'] =$this->uploadFile($request->image, 'users');

        $item->update($inputs);
        flashy(__('dashboard.updated'));
        return redirect()->route($this->resource['route'].'.index', [$lang, $value]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, $value, $id)
    {
        App::setLocale($lang);
        $item = ProductImage::findOrFail($id);
        if (strpos($item->image, '/uploads/') !== false) {
            $image = str_replace( asset('').'storage/', '', $item->image);
            Storage::disk('public')->delete($image);
        }
        $item->delete();
        return redirect()->route($this->resource['route'].'.index', [$lang, $value]);
    }

    public function multiDelete($lang, $value)
    {
        App::setLocale($lang);
        foreach (\request('checked') as $id)
        {
            $item = ProductImage::findOrFail($id);
            if (strpos($item->image, '/uploads/') !== false) {
                $image = str_replace( asset('').'storage/', '', $item->image);
                Storage::disk('public')->delete($image);
            }
            $item->delete();
        }

        flashy(__('dashboard.deleted'));
        return redirect()->route($this->resource['route'].'.index', [$lang, $value]);
    }

    public function search($lang, Request $request, $value)
    {
        App::setLocale($lang);
        $resource = $this->resource;
        $data = City::where('country_id', $value)
            ->where(function ($query) use ($request){
                $query->where('name_ar', 'LIKE', '%'.$request->text.'%')
                    ->orWhere('name_en', 'LIKE', '%'.$request->text.'%');
            })
            ->paginate(10);
        return view('dashboard.views.' .$this->resources. '.index', compact('data', 'resource', 'value'));
    }
}
