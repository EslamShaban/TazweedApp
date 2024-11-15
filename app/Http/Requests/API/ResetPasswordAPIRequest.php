<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rules\Password;

class ResetPasswordAPIRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'         => ['required', 'email', 'exists:users,email'],
            'password'      => ['required', Password::min(6)->mixedCase()->numbers()->symbols()->uncompromised(), 'confirmed']
        ];
    }

        
    public function attributes()
    {
        return[
            'email'         => __('api.email'),
            'password'      => __('api.password'),   
        ];
        
    }

    public function failedValidation(Validator $validator)
    {
        
        $error = $validator->errors()->toArray();

        if ( isset($error['email']) ) {
            $msg = $error['email'][0];
            $field = 'email';
            $code = 5001;
        } elseif ( isset($error['password']) ) {
            $msg = $error['password'][0];
            $field = 'password';
            $code = 5002;
        }else {
            $msg = __('api.error');
            $code = 5000;
        }


        throw new HttpResponseException(response()->withError($msg, $code, $field));
    }
}
