<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand',
        'model',
        'year',
        'engine',
        'registration_number',
        'vin'
    ];


    public function reportedCars()
    {
        return $this->hasMany('App\Models\ReportedCar');
    }




}
