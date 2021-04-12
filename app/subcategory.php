<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subcategory extends Model
{
     protected $guarded=[];

  public function products()
    {
        return $this->hasMany('App\Product', 'sub_id');
    }

    /**
     * Get all of the categories for the subcategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category', 'products', 'cat_id', 'sub_id');

    }

    /**
     * Get the fair that owns the subcategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fair()
    {
        return $this->belongsTo('App\Fair', 'fair_id');
    }

    //    public function products()
    // {
    //     return $this->hasManyThrough(Product::class, Suite::class ,'fair_id','suite_id','id','id');
    // }
}
