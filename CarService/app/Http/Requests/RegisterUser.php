<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUser extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nazwa użytkownika jest wymagana',
            'email.required' => 'Prawidłowy adres e-mail jest wymagany',
            'password.required' => 'Hasło jest wymagane',
            'confirm_password.required' => 'Prawidłowe powtócrzenie hasła jest wymagane',
        ];
    }
}
