<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
class SocialAPIRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'     => ['required', 'email']
        ];
    }

        
    public function attributes()
    {
        return[
            'email'     => 'البريد الإلكتروني'
        ];
        
    }

    public function failedValidation(Validator $validator)
    {
        
        $error = $validator->errors()->toArray();

        if ( isset($error['email']) ) {
            $msg = $error['email'][0];
            $field = 'email';
            $code = 5001;
        } else {
            $msg = __('api.error');
            $code = 5000;
        }


        throw new HttpResponseException(response()->withError($msg, $code, $field));
    }
}
