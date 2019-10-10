<?php

namespace App\Http\Controllers\Website;

use App\Models\Cart;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Validator;
use Auth;

class ContactController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lang)
    {
        $data = Contact::orderBy('id')->paginate(10);
        return view('website.views.contacts.index',compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $admin
     * @return \Illuminate\Http\Response
//     */
//    public function show($lang, $id)
//    {
//        $data = SubCategory::where('category_id', $id)->paginate(10);
//        return view('website.views.categories.',compact('data'));
//    }

}
