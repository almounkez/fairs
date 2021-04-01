<?php

namespace App;
use App\Suite;
use App\Fair;

use Illuminate\Database\Eloquent\Model;

class MailList extends Model
{
    protected $guarded=[];
    //
    /**
     * Get the Suite that owns the MailList
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function source()
    {
        if( $this->source_type=='suite')
                return $this->belongsTo('App\Suite', 'source_id');
        else if($this->source_type=='fair')
        return $this->belongsTo('App\Fair', 'source_id');
        else return null;
    }
}

