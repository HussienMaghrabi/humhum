<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Banner;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\CommonQuestion;
use App\Models\Complaint;
use App\Models\Contact;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\User;
use App\Models\Category;
use App\Models\City;
use App\Models\Vendor;

class HomeController extends Controller
{
    private $resource = [
        'route' => 'admin.home',
        'icon' => "home",
        'title' => "DASHBOARD",
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
        $statistics = [
            'admins'            => Admin::count(),
            'banners'           => Banner::count(),
            'categories'        => Category::count(),
            'cities'            => City::count(),
            'contacts'          => Contact::count(),
            'complaints'        => Complaint::count(),
            'question'          => CommonQuestion::count(),
            'order'             => Order::count(),
            'offers'            => Offer::count(),
            'product'           => Product::where('status',2)->count(),
            'requestProducts'   => Product::where('status',1)->count(),
            'subcategories'     => SubCategory::count(),
            'sub2categories'    => SubSubCategory::count(),
            'settings'          => Setting::count(),
            'users'             => User::count(),
            'vendors'           => Vendor::count(),
        ];
        $resource = $this->resource;

        return view('dashboard.home', compact('statistics', 'resource'));
    }
}
