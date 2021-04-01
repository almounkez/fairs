<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suite extends Model
{
    protected $guarded = [];

    /**
     * Get the user that owns the Suite
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    /**
    * Get the fair that owns the Suite
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function fair()
    {
        return $this->belongsTo('App\Fair','fair_id');
    }

    /**
     * Get all of the slides for the Suite
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slides()
    {
        return $this->hasMany('App\Slide', 'suite_id');
    }
    /**
     * Get all of the products for the Suite
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Product', 'suite_id');
    }

    /**
     * Get all of the articles for the Suite
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany('App\Article','suite_id');
    }

    /**
     * Get all of the marquees for the Suite
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function marquees()
    {
        return $this->hasMany('App\Marquee','suite_id');
    }

    /**
     * Get all of the mails for the Suite
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mails()
    {
        return $this->hasMany('App\MailList','source_id')->where('mail_lists.source_type','suite');
    }

        /**
     * Get all of the mailLists for the Suite
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mailLists()
    {
        return $this->hasMany('App\MailList', 'source_id')->where('source_type','suite');
    }
}
