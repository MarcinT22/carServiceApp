<?php

namespace App\Http\Requests;

trait CommonRules
{

    protected function carRules()
    {
        return [
            'brand' => 'required|max:255',
            'model' => 'required|max:255',
            'year' => 'required|integer',
            'engine' => 'required|integer',
            "fuel" => 'required',
            'registration_number' => 'required|unique:cars',
            'vin' => 'required|unique:cars'
        ];
    }
}