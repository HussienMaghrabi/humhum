<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

    protected $guarded = [];

    public function user(){

        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function carts()
    {
        return $this->hasMany('App\Models\OrderCart');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Status', 'status_id');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id');
    }

}
