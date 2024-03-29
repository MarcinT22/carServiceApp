<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginCar extends FormRequest
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
            'registration_number' => 'required',
            'vin' => 'required|max:5',
        ];
    }

    public function messages()
    {
        return [
            'registration_number.required' => 'Numer rejestracyjny jest nieprawidłowy.',
            'vin.required' => 'Podano nieprawidłowe znaki VIN.',
        ];
    }
}
