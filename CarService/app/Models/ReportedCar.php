<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportedCar extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'car_id',
        'description',
        'reported_car_date',
        'is_delivered',
        'is_accepted'
    ];

    public function car()
    {
        return $this->belongsTo('App\Models\Car');
    }
    
    public function event()
    {
        return $this->hasOne('App\Models\Event');
    }
}
