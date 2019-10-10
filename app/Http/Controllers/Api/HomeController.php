<?php

namespace App\Http\Controllers\Api;



use App\Models\Banner;
use App\Http\Controllers\Controller;
use App\Models\StorePrice;
use Validator;
use Auth;

class HomeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $auth = $this->auth();
        $lang = request()->header('lang');
        $data['home']['banners'] = Banner::select("image")->get()->pluck("image");

        $data['home']['most_view'] = StorePrice::orderBy('view', 'DESC')->where('city_id',request('city_id'))->select(
            "id",
            'price_before',
            'price_after',
            'product_id',
            'view'
        )
         ->take(10)
         ->get();

        $data['home']['most_view']->map(function ($item) use ($lang, $auth) {

            $item->name = $item->Product["name_$lang"];
            $item->Description = $item->Product["desc_$lang"];
            $item->image = $item->Product->image;
            $item->has_favorite = $item->has_favorite($auth);
            $item->has_cart = $item->has_cart($auth);

            unset($item->Product);
            unset($item->view);

        });

        $data['home']['most_sell'] = StorePrice::orderBy('sells', 'DESC')->where('city_id',request('city_id'))->select(
            "id",
            'price_before',
            'price_after',
            'product_id',
            'sells'
        )
            ->take(10)
            ->get();

        $data['home']['most_sell']->map(function ($item) use ($lang, $auth) {

            $item->name = $item->Product["name_$lang"];
            $item->Description = $item->Product["desc_$lang"];
            $item->image = $item->Product->image;
            $item->has_favorite = $item->has_favorite($auth);
            $item->has_cart = $item->has_cart($auth);

            unset($item->Product);
            unset($item->view);

        });

        return $this->successResponse($data);
    }
}
