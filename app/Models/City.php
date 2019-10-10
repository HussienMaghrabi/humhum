<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];

    public function vendor()
    {
        return $this->hasMany('App\Models\Vendor', 'city_id');
    }

    public static function boot()
    {
        parent::boot();

        static::deleted(function($item)
        {
            $item->vendor()->delete();
        });
    }
}
