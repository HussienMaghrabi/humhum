<?php

namespace App\Http\Controllers\Vendor;


use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderCart;
use App\Models\Product;
use App\Models\StorePrice;
use Auth;

class HomeController extends Controller
{
    private $resource = [
        'route' => 'store.home',
        'icon' => "home",
        'title' => "STORE",
        'action' => "",
        'header' => "home"
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $data = OrderCart::where('vendor_id',Auth::guard('vendor')->user()->id)
            ->select('order_id')
            ->groupBy('order_id')
            ->get();
        $statistics = [
            'product'           => Product::where('vendor_id',Auth::guard('vendor')->user()->id)->count(),
            'order'             => Order::whereIn('id',$data)->count(),
            'price'             => StorePrice::where('vendor_id',Auth::guard('vendor')->user()->id)->count(),
        ];
        $resource = $this->resource;

        return view('vendor.home', compact('statistics', 'resource'));
    }
}
