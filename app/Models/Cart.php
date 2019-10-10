<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    protected $guarded = [];

    public function user(){

        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function Product(){

        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function store_price(){

        return $this->belongsTo('App\Models\StorePrice', 'price_id');
    }

}
