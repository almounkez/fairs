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
}
