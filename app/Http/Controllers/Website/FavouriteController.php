<?php

namespace App\Http\Controllers\Website;

use App\Models\Cart;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Validator;
use Auth;

class FavouriteController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lang)
    {
        $data = Favorite::orderBy('id')->paginate(10);
        return view('website.views.favourites.index',compact('data'));
    }


}
