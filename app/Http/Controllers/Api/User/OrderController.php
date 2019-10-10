<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\City;
use App\Models\Order;
use App\Models\OrderCart;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Vendor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
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

        $data['current'] = Order::where('city_id',request('city_id'))
            ->where('user_id', $auth)
            ->with("status:id,name_$lang as name")
            ->paginate(10);
        $data['current']->map(function ($item) use ($lang)
        {
            if ($item->payment) $item->payment = (int)$item->payment;
            $item->quantity = $item->carts()->count();
            $item->total = round($item->cost + $item->vat + $item->city->cost_delivery,2);
            $item->date = date('Y-m-d', strtotime($item->created_at));

            unset($item->user_id);
            unset($item->city_id);
            unset($item->city);
            unset($item->carts);
            unset($item->cart_id);
            unset($item->cart);
            unset($item->created_at);
            unset($item->updated_at);

        });


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
        $this->lang();
        $auth = $this->auth();
        $rules = [
            'payment' => 'required',
            'address' => 'required',
        ];

        $validator = Validator::make(request()->all(), $rules);
        $errors = $this->formatErrors($validator->errors());
        if ($validator->fails()) {
            return $this->errorResponse($errors);
        }

        $carts = Cart::where('user_id', $auth)->where('status', 1)->get();

        $inputs = request()->all();
        $inputs['cost'] = $carts->sum('price');
        $inputs['vat'] = $inputs['cost'] * Setting::first()->vat / 100;
        $inputs['user_id'] = $auth;
        $inputs['city_id'] = request('city_id');
        $inputs['status_id'] = 1;
        $order = Order::orderBy('order_number', 'desc')->first();
        if ($order) {
            $inputs['order_number'] = $order->order_number + 1;
        } else {
            $inputs['order_number'] = 5000;
        }
        if($inputs['cost'] <= Setting::first()->maximum) {
            foreach ($carts as $cart) {
                if ($cart->store_price->quantity >= $cart->quantity) {

                    if ($cart->quantity  <= $cart->store_price->maximum){
                        $order = Order::create($inputs);


                        $cart->store_price()->update([
                            'quantity' => $cart->store_price->quantity - $cart->quantity,
                        ]);
                        $cart->Product()->update([
                            'sells' => $cart->sells + 1
                        ]);

                        $cart->update(['status' => 2]);
                        OrderCart::create([
                            'order_id' => $order->id,
                            'cart_id' => $cart->id,
                            'vendor_id' => $cart->store_price->vendor->id,
                        ]);


                        return $this->successResponse(null, __('api.OrderCreated'));
                    }else {
                        $max = $cart->store_price->maximum;
                        $data = "الحد الاقصي للطلبات هو $max في المره ";
                        return $this->errorResponse($data, __('api.maximum'));
                    }
                } else {
                    return $this->errorResponse(null, __('api.quantity'));
                }
            }
        }else {
            return $this->errorResponse(null, __('api.maximum'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lang = $this->lang();
        $auth = $this->auth();
        $data['order'] = Order::where('id',$id)
            ->with("status:id,name_$lang as name")
            ->first();


        $data['order']->date = date('Y-m-d ', strtotime($data['order']->created_at));
        unset($data['order']->created_at);
        unset($data['order']->updated_at);
        $data['order']->products = Cart::whereIn('id', $data['order']->Carts()->select('cart_id')->get())
        ->select(
            'id',
            'quantity',
            'price',
            'product_id'
        )->get();

        $data['order']->products->map(function ($item) use ($lang)
        {
//            $item->quantity = $item->carts()->count();
            $item->name = $item->Product["name_$lang"];
            $item->image = $item->Product->image;
            $item->store = $item->Product->vendor["name_$lang"];

            unset($item->product_id);
            unset($item->Product);
        });


        $data['order']->quantity = $data['order']->carts()->count();
        $data['order']->price = $data['order']->cost;
        $data['order']->delivery = $data['order']->city->cost_delivery  ;
        $data['order']->total =   $data['order']->price + $data['order']->delivery ;

        unset($data['cost']);
        unset($data['order']->city);

        return $this->successResponse($data);
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
        $auth = $this->auth();
//        $rules =  [
//            'status'  => 'required',
//        ];
//
//        $validator = Validator::make(request()->all(), $rules);
//        $errors = $this->formatErrors($validator->errors());
//        if($validator->fails()) {return $this->errorResponse($errors);}

        Order::find($id)->update(request()->all());
        return $this->successResponse(null, __('api.OrderUpdated'));
    }

    public function offer($id)
    {
        $this->lang();
        $auth = $this->auth();
        $data['offers'] = Offer::where('order_id', $id)->select('id', 'time', 'cost', 'driver_id')
                                ->with('Driver:id,name,image,car_model,car_number,car_type')->get();

        $data['offers']->map(function ($item)
        {
            unset($item->driver_id);
        });

        return $this->successResponse($data);
    }

    public function driver($id)
    {
        $this->lang();
        $auth = $this->auth();
        $data['driver'] = Driver::where('id', $id)
                                ->select('id', 'name', 'phone', 'car_model', 'car_type', 'car_number', 'image', 'average_rate')
                                ->first();

        $data['driver']->rate_number = $data['driver']->Rate()->count();

        if ($data['driver']->rate_namber > 0)
        {
            $data['driver']->rates = $data['driver']->Rate()->where('type', 1)
                ->select('id', 'comment', 'rate', 'user_id', 'created_at as date')
                ->with("User:id,name,image")->get();
        }
        else
        {
            $data['driver']->rates= null;
        }

        return $this->successResponse($data);
    }

    public function addOffer($id)
    {
        $this->lang();
        $auth = $this->auth();
        $rules =  [
            'offer'  => 'required|exists:offers,id',
        ];

        $validator = Validator::make(request()->all(), $rules);
        $errors = $this->formatErrors($validator->errors());
        if($validator->fails()) {return $this->errorResponse($errors);}

        Offer::find(request('offer'))->update(['status' => 2]);
        Order::find($id)->update(['status' => 2]);
        return $this->successResponse(null, __('api.OfferAccept'));
    }

    public function data($id)
    {
        $lang = $this->lang();
        $auth = $this->auth();
        $offer = Offer::where('order_id', $id)->where('status', 2)->first();
        $data['driver'] = $offer->Driver()->select('id', 'name', 'image')->first();

        $data['stores'] = Store::whereIn('id', OrderCart::where('order_id', $id)->select('store_id')->get())
                                ->select('id', "name_$lang as name", 'image')->get();

        return $this->successResponse($data);
    }

    public function rate($id)
    {
        $this->lang();
        $auth = $this->auth();
        $rules =  [
            'rate'  => 'required',
            'comment'  => 'required',
            'type'  => 'required',
            'id'  => 'required',
        ];

        $validator = Validator::make(request()->all(), $rules);
        $errors = $this->formatErrors($validator->errors());
        if($validator->fails()) {return $this->errorResponse($errors);}

        if (request('type') == 2)
        {
            Rate::create([
                'rate' => request('rate'),
                'comment' => request('comment'),
                'order_id' => $id,
                'user_id' => $auth,
                'store_id' => request('id'),
            ]);

            $rates = Rate::where('store_id', request('id'))->get();
            Store::find(request('id'))->update(['average_rate' => ($rates->sum('rate') / count($rates))]);
        }
        else
        {
            Rate::create([
                'rate' => request('rate'),
                'comment' => request('comment'),
                'order_id' => $id,
                'user_id' => $auth,
                'type' => 1,
                'driver_id' => request('id'),
            ]);

            $rates = Rate::where('driver_id', request('id'))->where('type', 1)->get();
            Driver::find(request('id'))->update(['average_rate' => ($rates->sum('rate') / count($rates))]);
        }

        return $this->successResponse(null, __('api.RateSuccess'));
    }
}
