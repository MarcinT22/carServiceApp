<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCar extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'brand'=>'required|max:255',
            'model'=>'required|max:255',
            'year'=>'required|integer',
            'engine'=>'required',
            'registration_number'=>'required|unique:cars',
            'vin'=>'required|unique:cars'
        ];
    }
}
