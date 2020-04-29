<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_id',
        'description',
        'is_accepted'
    ];

    public function event()
    {
        return $this->belongsTo('App\Models\Event');
    }
}
