<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CaptainApproveRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'request_id'       => ['required', 'exists:wash_requests,id'],
        ];
    }


         
    public function attributes()
    {
        return[

            'request_id'  => 'رقم الطلب'   
        ];
        
    }

    public function failedValidation(Validator $validator)
    {
        
        $error = $validator->errors()->toArray();

        if ( isset($error['request_id']) ) {
            $msg = $error['request_id'][0];
            $field = 'request_id';
            $code = 5001;
        } else {
            $msg = __('api.error');
            $code = 5000;
        }

        throw new HttpResponseException(response()->withError($msg, $code, $field));
    }
}
