<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Setting;
use App\Models\StorePrice;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lang = $this->lang();
        $auth = $this->auth();
        $data['cart'] = Cart::select('id', 'text', "quantity", 'product_id', 'price', 'price_id')
            ->where('user_id', $auth)
            ->where('status', 1)
            ->get();

        $data['money'] = $data['cart']->sum('price');
        $data['cart']->map(function ($item) use ($lang)
        {
            $item->store = $item->store_price->vendor["name_$lang"];
            $item->name =  $item->store_price->Product["name_$lang"];
            $item->image = $item->store_price->Product->image;

            unset($item->Product);
            unset($item->store_price);
        });
        $data['vat'] = round(($data['money'] * Setting::first()->vat/100), 2);
        $data['total'] = round(($data['vat'] + $data['money']),2);


        return $this->successResponse($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $lang = $this->lang();
        $auth = $this->auth();
        $rules =  [
            'product'  => 'required|exists:store_prices,id',


        ];

        $validator = Validator::make(request()->all(), $rules);
        $errors = $this->formatErrors($validator->errors());
        if($validator->fails()) {return $this->errorResponse($errors);}


            $product = StorePrice::Where('id',request('product'))->first();
            Cart::create([
                'quantity' => 1,
                'text'  => request('text')?request('text'):null,
                'product_id' => $product->product_id,
                'user_id' => $auth,
                'price' => $product->price_after,
                'price_id'=> $product->id
            ]);

            return $this->successResponse(null, __('api.Cart'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $this->lang();
        $rules =  [

            'quantity' => 'required|int'
        ];

        $validator = Validator::make(request()->all(), $rules);
        $errors = $this->formatErrors($validator->errors());
        if($validator->fails()) {return $this->errorResponse($errors);}

        $item = Cart::find($id);
        $item->update([
            'quantity' => request('quantity'),
            'price' => $item->store_price->price_after * request('quantity'),
        ]);

        return $this->successResponse(null, __('api.IncreaseProduct'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::where('user_id' , $this->auth())
            ->where('product_id' , $id)
            ->where('status',1)
            ->delete();
        return $this->successResponse(null, __('api.UnCart'));
    }
}
