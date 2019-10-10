<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    //
    protected $guarded = [];

    public function user(){

        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function price(){

        return $this->belongsTo('App\Models\StorePrice', 'price_id');
    }

}
