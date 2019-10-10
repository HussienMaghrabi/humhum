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

class ProductViewController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(){
         $lang = request()->header('lang');
         $auth = $this->auth();

         $data['most_view'] = StorePrice::where('city_id',request('city_id'))->select(
             "id",
             "product_id"
         )->orderBy('view', 'DESC')
         ->paginate(10);
         $data['most_view']->map(function ($item) use ($lang, $auth) {

             $item->name = $item->Product["name_$lang"];
             $item->Description = $item->Product["desc_$lang"];
             $item->image = $item->Product->image;
             $item->has_favorite = $item->has_favorite($auth);
             $item->has_cart = $item->has_cart($auth);
             unset($item->Product);

         });

        return $this->successResponse($data);
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
     public function show($id){
         $lang = request()->header('lang');
         $data['product'] = Product::where('id', $id)->where('status',2)->select(
             "id",
             "name_$lang as name",
             "desc_$lang as Description",
             'price_before',
             'price_after',
             'view',
             'sub_category_id',
             "sub_sub_category_id as sub2Category_id",
             "image"
         )->first();


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
