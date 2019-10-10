<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\StorePrice;
use Illuminate\Support\Facades\Validator;

class FavoriteController extends Controller
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
        $data['products'] = StorePrice::select(
            'id',
            'price_before',
            'price_after',
            'product_id'
        )->whereIn('id', Favorite::where('user_id', $auth)
            ->select('product_id')->get())
            ->get();

        $data['products']->map(function ($item) use ($lang, $auth)
        {
            $item->name = $item->Product["name_$lang"];
            $item->Description = $item->Product["desc_$lang"];
            $item->image = $item->Product->image;
            $item->has_favorite = $item->Product->has_favorite($auth);
            $item->has_cart = $item->Product->has_cart($auth);
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
        $rules =  [
            'product'  => 'required|exists:store_prices,id',
        ];

        $validator = Validator::make(request()->all(), $rules);
        $errors = $this->formatErrors($validator->errors());
        if($validator->fails()) {return $this->errorResponse($errors);}

        $item = Favorite::where('user_id', $auth)->where('price_id', request('price_id'))->first();
        if ($item)
        {
            $item->delete();
            return $this->successResponse(null, __('api.UnLike'));
        }
        else
        {
            Favorite::create([
                'user_id' => $auth,
                'price_id' => request('product')
            ]);
            return $this->successResponse(null, __('api.Like'));
        }
    }
}
