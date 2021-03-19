<?php

namespace App;
use App\Suite;
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
            return Suite::where('suites.id',$this->source_id)->get();
    }
}

