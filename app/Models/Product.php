<?php

namespace App\Models;

use App\Models\Favorite;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Product extends Model
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

    public function sub_category(){
        return $this->belongsTo('App\Models\SubCategory', 'sub_category_id');
    }

    public function sub_sub_category(){
        return $this->belongsTo('App\Models\SubSubCategory', 'sub_sub_category_id');
    }

    public function image(){
        return $this->hasMany('App\Models\ProductImage', 'product_id');
    }

    public function price(){
        return $this->hasMany('App\Models\StorePrice', 'product_id');
    }



}


