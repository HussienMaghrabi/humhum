<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];

    public function getImageAttribute($value)
    {
        if ($value)
        {
            return asset(Storage::url($value));
        }
    }

    public function category(){
        return $this->hasMany('App\Models\SubCategory');
    }

    public function vendor()
    {
        return $this->hasMany('App\Models\Vendor', 'category_id');
    }

    public static function boot()
    {
        parent::boot();

        static::deleted(function($item)
        {
            $item->Category()->delete();
            $item->vendor()->delete();
        });
    }
}
