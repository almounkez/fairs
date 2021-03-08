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
     /**
      * Get the fair that owns the Slide
      *
      * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
      */
     public function fair()
     {
         return $this->belongsTo('App\Fair', 'fair_id');
     }
          /**
      * Get the fair that owns the Slide
      *
      * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
      */
     public function suite()
     {
         return $this->belongsTo('App\Suite', 'suite_id');
     }
}
