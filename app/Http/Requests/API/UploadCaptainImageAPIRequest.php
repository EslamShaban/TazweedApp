<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UploadCaptainImageAPIRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image'     => ['required', 'image', 'mimes:jpg,jpeg,png,gif'],
        ];
    }


         
    public function attributes()
    {
        return[

            'image'  => __('api.image')   
        ];
        
    }

    public function failedValidation(Validator $validator)
    {
        
        $error = $validator->errors()->toArray();

        if ( isset($error['image']) ) {
            $msg = $error['image'][0];
            $field = 'image';
            $code = 5001;
        } else {
            
            $msg = __('api.error');
            $field = null;
            $code = 5000;

        }

        throw new HttpResponseException(response()->withError($msg, $code, $field));
    }
}
