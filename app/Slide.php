<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
     protected $guarded=[];

     /**
      * Get the category that owns the Slide
      *
      * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
      */
     public function category()
     {
         return $this->belongsTo('App\Category', 'cat_id');
     }
}
