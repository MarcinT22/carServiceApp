<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Car extends Authenticatable
{

    use HasApiTokens;
    protected $guard = 'cars';
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
        'fuel',
        'registration_number',
        'vin',
        'password'
    ];

    protected $hidden = [
        'password',
    ];



    public function reportedCars()
    {
        return $this->hasMany('App\Models\ReportedCar');
    }




}
