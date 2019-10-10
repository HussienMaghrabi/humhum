<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Authenticatable
{
    //
    use SoftDeletes;
    protected $guarded = [];

    public function setPasswordAttribute($password){

        if(!empty($password)){

            $this->attributes['password'] = bcrypt($password);
        }
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function product(){
        return $this->hasMany('App\Models\Product', 'vendor_id');
    }

    public static function boot()
    {
        parent::boot();

        static::deleted(function($item)
        {
            $item->product()->delete();
        });
    }
}
