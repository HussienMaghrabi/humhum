<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    //
    protected $guarded = [];

    public function Product(){

        return $this->belongsTo('App\Models\Product', 'product_id');
    }

}
