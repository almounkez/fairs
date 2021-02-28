<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fair extends Model
{
    protected $guarded = [];
    protected $dates = ['start_date','end_date'];


    /**
    * Get all of the suites for the Fair
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */

    public function suites()
    {
        return $this->hasMany(Suite::class, 'fair_id');
    }

        /**
     * Get all of the categories for the Fair
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->hasMany('App\Category', 'fair_id');
    }

    /**
     * Get all of the slides for the Fair
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slides()
    {
        return $this->hasMany('App\Slide', 'fair_id');
    }
        /**
     * Get all of the slides for the Fair
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function advertises()
    {
        return $this->hasMany('App\Advertise', 'fair_id');
    }
}

