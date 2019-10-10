<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Validator;
use Auth;

class SettingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lang = request()->header('lang');
        $data = Setting::select(
            "about_$lang as about",
            "privacy_$lang as privacy",
            "term_$lang as terms",
            "how_to_sell_$lang as how_to_sell",
            "term_sale_$lang as term_sale",
            "sell_policy_$lang as sell_policy"
        )->first();
        return $this->successResponse($data);
    }

}
