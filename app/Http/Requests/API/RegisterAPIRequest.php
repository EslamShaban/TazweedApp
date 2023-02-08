<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rules\Password;

class RegisterAPIRequest extends FormRequest
{
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
            'email'         => ['required', 'email', 'unique:users'],
            'city_id'       => ['required', 'exists:cities,id'],
            'password'      => ['required', Password::min(6)->mixedCase()->numbers()->symbols()->uncompromised(), 'confirmed'],
            'image'         => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif'],
            'fcm'           => ['nullable']
        ];
    }


         
    public function attributes()
    {
        return[

            'f_name'        => 'الإسم الاول',
            'l_name'        => 'الإسم الاخير',
            'email'         => 'البريد الإلكتروني',
            'city_id'       => 'المحافظة', 
            'password'      => 'كلمة السر', 
            'image'         => 'الصورة'    
        ];
        
    }

    public function failedValidation(Validator $validator)
    {
        
        $error = $validator->errors()->toArray();

        if ( isset($error['f_name']) ) {
            $msg = $error['f_name'][0];
            $field = 'f_name';
            $code = 5001;
        } elseif ( isset($error['l_name']) ) {
            $msg = $error['l_name'][0];
            $field = 'l_name';
            $code = 5002;
        } elseif ( isset($error['email']) ) {
            $msg = $error['email'][0];
            $field = 'email';
            $code = 5003;
        } elseif ( isset($error['city_id']) ) {
            $msg = $error['city_id'][0];
            $field = 'city_id';
            $code = 5004;
        } elseif ( isset($error['password']) ) {
            $msg =  $error['password'][0];
            $field = 'password';
            $code = 5005;
        } elseif ( isset($error['image']) ) {
            $msg = $error['image'][0];
            $field = 'image';
            $code = 5006;
        }else {
            $msg = __('api.error');
            $code = 5000;
        }

        throw new HttpResponseException(response()->withError($msg, $code, $field));
    }
}
