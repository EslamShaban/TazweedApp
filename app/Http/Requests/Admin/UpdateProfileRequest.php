<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'f_name'        => ['required', 'string'],
            'l_name'        => ['required', 'string'],
            'email'         => ['required', 'email', 'unique:users,email,' . auth()->user()->id],
            'password'      => ['nullable'],
            'image'         => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif']
        ];

    }

     public function attributes()
    {
        return[
            'f_name'        => 'الإسم الاول',
            'l_name'        => 'الإسم الاخير',
            'email'         => 'البريد الالكتروني',
            'password'      => 'كلمة المرور',
            'image'         => 'الصورة'
        ];
        
    }
}
