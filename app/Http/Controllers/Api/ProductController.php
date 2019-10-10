<?php

namespace App\Http\Controllers\Api;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(){

         $lang = request()->header('lang');
         $auth = $this->auth();
         if (request('sub_category_id')){
             $data['product'] = StorePrice::where('city_id',request('city_id'))->where('sub_category_id',request('sub_category_id') )->select(
                 "id",
                 'view',
                 'sells',
                 'city_id',
                 'sub_category_id',
                 "sub_sub_category_id",
                 'product_id',
                 'vendor_id'
             )->paginate(10);
             $data['product']->map(function ($item) use ($lang, $auth) {
                 $item->name = $item->Product["name_$lang"];
                 $item->Description = $item->Product["desc_$lang"];
                 $item->image = $item->Product->image;
                 $item->images = $item->Product->image()->pluck('image');
                 $item->has_favorite = $item->has_favorite($auth);
                 $item->has_cart = $item->has_cart($auth);

                 unset($item->Product);
                 unset($item->sub_category_id);
                 unset($item->sub_sub_category_id);
             });

         }else{
             $data['product'] = StorePrice::where('city_id',request('city_id'))->where('sub_sub_category_id',request('sub_sub_category_id') )->select(
                 "id",
                 'view',
                 'sells',
                 'city_id',
                 'sub_category_id',
                 "sub_sub_category_id",
                 'product_id',
                 'vendor_id'
             )->paginate(10);
             $data['product']->map(function ($item) use ($lang, $auth) {
                 $item->name = $item->Product["name_$lang"];
                 $item->Description = $item->Product["desc_$lang"];
                 $item->image = $item->Product->image;
                 $item->images = $item->Product->image()->pluck('image');
                 $item->has_favorite = $item->has_favorite($auth);
                 $item->has_cart = $item->has_cart($auth);

                 unset($item->Product);
                 unset($item->sub_category_id);
                 unset($item->sub_sub_category_id);
             });

         }
         return $this->successResponse($data);
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $auth = $this->auth();
        $lang = request()->header('lang');

        $data['product'] = StorePrice::where('id', $id)->select(
             "id",
             'view',
             'sub_category_id',
             "sub_sub_category_id",
            'product_id',
            'vendor_id',
            'price_after'
        )->first();


        $data['product']->update(['view'=>$data['product']->view+1]);
        $data['product']->name = $data['product']->Product["name_$lang"];
        $data['product']->Description = $data['product']->Product["desc_$lang"];
        $data['product']->image = $data['product']->Product->image;

        $data['product']->images = $data['product']->Product->image()->pluck('image');
        $data['product']->has_favorite = $data['product']->has_favorite($auth);
        $data['product']->has_cart = $data['product']->has_cart($auth);

        unset($data['product']->Product);

        if ($data['product']->sub_sub_category_id){
            $data['product']['similar_goods']= StorePrice::
            where('sub_sub_category_id',$data['product']->sub_sub_category_id)
            ->where('product_id','!=',$id)
            ->where('vendor_id','!=',request('vendor_id'))
            ->select("id", "product_id")
            ->orderBy('id')
            ->take(10)
            ->get();
            $data['product']['similar_goods']->map(function ($item) use ($lang, $auth) {
                 $item->name = $item->Product["name_$lang"];
                 $item->Description = $item->Product["desc_$lang"];
                 $item->image = $item->Product->image;
                 $item->has_favorite = $item->has_favorite($auth);
                 $item->has_cart = $item->has_cart($auth);

                unset($item->Product);
            });
        }else{
             $data['product']['similar_goods']= StorePrice::
             where('sub_category_id',$data['product']->sub_category_id)
             ->where('product_id','!=',$id)
             ->where('vendor_id','!=',request('vendor_id'))
             ->select("id", "product_id")
             ->orderBy('id')
             ->take(10)
             ->get();
             $data['product']['similar_goods']->map(function ($item) use ($lang, $auth) {
                 $item->name = $item->Product["name_$lang"];
                 $item->Description = $item->Product["desc_$lang"];
                 $item->image = $item->Product->image;
                 $item->has_favorite = $item->has_favorite($auth);
                 $item->has_cart = $item->has_cart($auth);

                 unset($item->Product);
             });
        }

        return $this->successResponse($data);
    }





    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function create(Request $request){

        $rules =  [
            'name_ar' => 'required',
            'name_en' => 'required',
            'image'   => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return $this->errorResponse($validator->errors()->all()[0]);
        }
         $input = $request->except('image');
         if( $request->image) {
             $input['image'] = $this->uploadBase64($request['image']);
         }

        $data['category'] = Category::create($input);
         $message = __('dashboard.created');
        return $this->successResponse($data, $message);
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request,$id){

        $rules =  [
            'name_ar' => 'required',
            'name_en' => 'required',
            'image'   => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return $this->errorResponse($validator->errors()->all()[0]);
        }
         $input = $request->except('image');
         if( $request->image) {
             $user = Category::findOrFail($id);
             $path = parse_url($user->image);
             unlink(public_path($path['path']));

             $input['image'] = $this->uploadBase64($request['image']);
         }

        $data['category'] = Category::find($id);
        $data['category']->update($input);
        $message = __('dashboard.updated');
        return $this->successResponse($data, $message);
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
     public function destroy($id){

        $data = Category::findOrFail($id);
         if($data->image){
             $path = parse_url($data->image);
             unlink(public_path($path['path']));
         }
        $data->delete();
        $message = __('dashboard.deleted');
        return $this->successResponse(null, $message);
     }
}
