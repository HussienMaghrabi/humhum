<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StorePrice extends Model
{
    //
    protected $guarded = [];

    public function Product(){
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function vendor(){
        return $this->belongsTo('App\Models\Vendor', 'vendor_id');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id');
    }

    public function has_favorite($id)
    {
        if (Favorite::where('price_id', $this->id)->where('user_id',$id)->first())
        {
            return true;
        }
        return false;
    }

    public function has_cart($id)
    {
        if (Cart::where('price_id', $this->id)->where('status',1)->where('user_id',$id)->first())
        {
            return true;
        }
        return false;
    }

}
