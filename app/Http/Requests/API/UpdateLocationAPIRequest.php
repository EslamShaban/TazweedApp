<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateLocationAPIRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'lat'           => ['required'],
            'lng'           => ['required']
        ];
    }


         
    public function attributes()
    {
        return[

            'lat'       => __('api.lat'),
            'lng'       => __('api.lng')  
        ];
        
    }

    public function failedValidation(Validator $validator)
    {
        
        $error = $validator->errors()->toArray();

        if ( isset($error['lat']) ) {
            $msg = $error['lat'][0];
            $field = 'lat';
            $code = 5001;
        } elseif ( isset($error['lng']) ) {
            $msg = $error['lng'][0];
            $field = 'lng';
            $code = 5002;
        } else {
            $msg = __('api.error');
            $code = 5000;
        }

        throw new HttpResponseException(response()->withError($msg, $code, $field));
    }
}
