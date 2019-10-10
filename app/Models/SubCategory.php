<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class SubCategory extends Model
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
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function sub_category(){
        return $this->hasMany('App\Models\SubSubCategory', 'sub_category_id');
    }

    public function product(){
        return $this->hasMany('App\Models\Product', 'sub_category_id');
    }

    public function has_sub_category(){
        if($this->sub_category->count()>0){
            return true ;
        } else{
            return false ;
        }
    }

    public static function boot()
    {
        parent::boot();

        static::deleted(function($item)
        {
            $item->sub_category()->delete();
        });
    }
}
