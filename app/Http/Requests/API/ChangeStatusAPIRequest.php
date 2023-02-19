<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ChangeStatusAPIRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'status'       => ['required', 'in:1,2,3,4'],
            'images.0'     => ['required_if:status,3,4', 'image', 'mimes:jpg,jpeg,png,gif'],
            'images.1'     => ['required_if:status,3,4', 'image', 'mimes:jpg,jpeg,png,gif'],
            'images.2'     => ['required_if:status,3,4', 'image', 'mimes:jpg,jpeg,png,gif'],
            'images.3'     => ['required_if:status,3,4', 'image', 'mimes:jpg,jpeg,png,gif'],

        ];
    }


         
    public function attributes()
    {
        return[

            'status'  => 'الحالة'   
        ];
        
    }

    public function failedValidation(Validator $validator)
    {
        
        $error = $validator->errors()->toArray();

        if ( isset($error['status']) ) {
            $msg = $error['status'][0];
            $field = 'status';
            $code = 5001;
        } elseif ( isset($error['images.0']) ) {
            $msg = $error['images.0'][0];
            $field = 'images.0';
            $code = 5002;
        } elseif ( isset($error['images.1']) ) {
            $msg = $error['images.1'][0];
            $field = 'images.1';
            $code = 5002;
        } elseif ( isset($error['images.2']) ) {
            $msg = $error['images.2'][0];
            $field = 'images.2';
            $code = 5002;
        } elseif ( isset($error['images.3']) ) {
            $msg = $error['images.3'][0];
            $field = 'images.3';
            $code = 5002;
        } else {
            
            $msg = __('api.error');
            $field = null;
            $code = 5000;

        }

        throw new HttpResponseException(response()->withError($msg, $code, $field));
    }
}
