<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fair extends Model
{
    protected $guarded = [];
    protected $dates = ['start_date','end_date'];
}
