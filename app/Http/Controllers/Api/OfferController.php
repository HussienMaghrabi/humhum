<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Carbon\Carbon;

class OfferController extends Controller
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

        $data['current'] = Offer::select('id', 'cost', "product_id",'start')
            ->paginate(10);

//       dd($data['current']);
        $date = date(Carbon::now()->format('d-m-Y'));
        if($data['current']->start >= $date){
        $data['current']->map(function ($item) use ($lang)
        {
            $item->store = $item->Product->vendor["name_$lang"];
            $item->description = $item->Product["desc_$lang"];
            $item->name = $item->Product["name_$lang"];
            $item->price = $item->Product->price_after;


            unset($item->Product);
            unset($item->start);
        });

            return $this->successResponse($data);
        }
    }


}
