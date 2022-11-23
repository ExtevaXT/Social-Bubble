<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterValidation extends FormRequest
{
    /**
     * Determine if the users is authorized to make this request.
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
            'login'=>'required',
            'password'=>'required|min:6',
            'full_name'=>'required|regex:/^[АБВГДЕЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыьэюя\s]+$/',
            'country'=>'nullable',
            'city'=>'nullable',
            'hobby'=>'nullable',
            'birthday'=>'nullable',
        ];
    }
}
