<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id'
    ];

    public function events()
    {
        $this->hasMany('App\Models\Event');
    }

    public function user()
    {
        $this->belongsTo('App\Models\User');
    }
}
