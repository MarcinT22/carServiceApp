<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'start',
        'end',
        'backgroundColor',
        'status_id',
        'calendar_id',
        'reported_cars_id',
        'price',
    ];

    public function reportedCar()
    {
        return $this->belongsTo('App\Models\ReportedCar');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }

    public function alerts()
    {
        $this->hasMany('App\Models\Alert');
    }
    
    public function calendar()
    {
        $this->belongsTo('App\Models\Calendar');
    }
}
