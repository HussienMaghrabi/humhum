<?php

namespace App\Http\Controllers\Website;

use App\Models\Cart;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\StorePrice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Validator;
use Auth;

class CartController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lang)
    {
        App::setLocale($lang);
        if (Auth::guard('web')->check()) {
            $auth = Auth::guard('web')->user();
            $items = Cart::
            where('user_id', $auth->id)
            ->
            where('status', 1)
            ->get();
            $items->map(function ($item) use ($lang)
            {

                $item->product_name =  $item->store_price->Product["name_$lang"];
                $item->product_image = $item->store_price->Product->image;

                unset($item->Product);
                unset($item->store_price);
            });

            $settings = Setting::first();

            $sub_total = 0;

            foreach ($items as $item)
            {
                $sub_total += $item->price * $item->quantity;
            }

            $vat = $sub_total * $settings->vat / 100;

            $total = $sub_total + $vat;

            return view('website.views.carts.index', compact('items', 'sub_total', 'vat', 'total'));

        }else
        {
            return redirect(route('web.auth', App::getLocale()));
        }
    }

    public function store(Request $request, $lang)
    {
        $auth = Auth::guard('web')->user();

        App::setLocale($lang);

        $id = request('id');

        $product = StorePrice::find($id);

        $text = request('text');

        $cart = Cart::
        where('user_id', $auth->id)->
        where('price_id', $id)->
        where('status', 1)->
        first();

        if($cart)
        {
            $cart->quantity += 1;
            $cart->text = $request->desc;

            $cart->save();
        }
        else
        {
            Cart::create([
                'text' => $text,
                'quantity' => 1,
                'price' => $product->price_after,
                'status' => 1,
                'user_id' => $auth->id,
                'product_id' => $product->product_id,
                'price_id' => $id,
            ]);
        }

        return $cart ? 2 : 1;
    }


    public function increase($lang, $id)
    {
        App::setLocale($lang);

        $item = Cart::findOrFail($id);

        $item->quantity += 1;
        $item->text = request('text');
        $item->save();

        $auth = Auth::guard('web')->user();

        $items = Cart::
        where('user_id', $auth->id)->
        where('status', 1)
            ->get();

        $settings = Setting::first();

        $sub_total = 0;

        foreach ($items as $item)
        {
            $sub_total += $item->price * $item->quantity;
        }

        $vat = $sub_total * $settings->vat / 100;

        $total = $sub_total + $vat;

        $data['sub_total'] = $sub_total;
        $data['vat'] = $vat;
        $data['total'] = $total;

        return $data;
    }

    public function decrease($lang, $id)
    {
        App::setLocale($lang);

        $item = Cart::findOrFail($id);

        $item->quantity -= 1;
        $item->text = request('text');
        $item->save();

        $auth = Auth::guard('web')->user();

        $items = Cart::
        where('user_id', $auth->id)->
        where('status', 1)
            ->get();

        $settings = Setting::first();

        $sub_total = 0;

        foreach ($items as $item)
        {
            $sub_total += $item->price * $item->quantity;
        }

        $vat = $sub_total * $settings->vat / 100;

        $total = $sub_total + $vat;

        $data['sub_total'] = $sub_total;
        $data['vat'] = $vat;
        $data['total'] = $total;

        return $data;
    }


    public function delete($lang, $id)
    {
        App::setLocale($lang);

        Cart::find($id)->delete();

        $auth = Auth::guard('web')->user();

        $items = Cart::
        where('user_id', $auth->id)->
        where('status', 1)
            ->get();

        $settings = Setting::first();

        $sub_total = 0;

        foreach ($items as $item)
        {
            $sub_total += $item->price * $item->quantity;
        }

        $vat = $sub_total * $settings->vat / 100;

        $total = $sub_total + $vat;

        $data['sub_total'] = $sub_total;
        $data['vat'] = $vat;
        $data['total'] = $total;

        return $data;
    }



}
