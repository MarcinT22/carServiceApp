<?php

namespace App\Http\Requests;

trait CommonRules
{

    protected function carRules()
    {
        return [
            'brand' => 'required|max:255',
            'model' => 'required|max:255',
            'year' => 'required|integer|numeric',
            'engine' => 'required|integer|numeric',
            "fuel" => 'required',
            'registration_number' => 'required|unique:cars',
            'vin' => 'required|unique:cars'
        ];
    }
}
