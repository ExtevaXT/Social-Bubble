<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserUpdateValidation extends FormRequest
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
            'login' => [
                'required',
                Rule::unique('users', 'login')
                    ->ignore(Auth::user()->id)
            ],
            'full_name'=>'required|regex:/^[АБВГДЕЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыьэюя\s]+$/',
            'birthday'=>'nullable',
            'image'=>'nullable|image|max:2048',
            'current_password'=>'nullable|current_password',
            'password'=>'nullable|min:6|confirmed',
            'country'=>'nullable',
            'city'=>'nullable',
            'hobby'=>'nullable',
        ];
    }
}
