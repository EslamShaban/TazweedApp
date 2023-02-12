<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rules\Password;

class ChangePasswordAPIRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password'      => ['required'],
            'new_password'      => ['required', Password::min(6)->mixedCase()->numbers()->symbols()->uncompromised(), 'confirmed'],
        ];
    }


         
    public function attributes()
    {
        return[

            'old_password'      => __('api.old_password'),
            'new_password'      => __('api.new_password'),  
        ];
        
    }

    public function failedValidation(Validator $validator)
    {
        
        $error = $validator->errors()->toArray();

        if ( isset($error['old_password']) ) {
            $msg = $error['old_password'][0];
            $field = 'old_password';
            $code = 5001;
        } elseif ( isset($error['new_password']) ) {
            $msg = $error['new_password'][0];
            $field = 'new_password';
            $code = 5002;
        } else {
            $msg = __('api.error');
            $code = 5000;
        }

        throw new HttpResponseException(response()->withError($msg, $code, $field));
    }
}
