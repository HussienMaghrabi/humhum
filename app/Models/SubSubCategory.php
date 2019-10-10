<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class SubSubCategory extends Model
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

    public function product(){
        return $this->hasMany('App\Models\Product', 'sub_sub_category_id');
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
