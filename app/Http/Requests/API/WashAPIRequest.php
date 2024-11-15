<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class WashAPIRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'location'      => ['required', 'string'],
            'lat'           => ['required'],
            'lng'           => ['required']
        ];
    }


         
    public function attributes()
    {
        return[

            'location'  => __('api.location'),
            'lat'       => __('api.lat'),
            'lng'       => __('api.lng')    
        ];
        
    }

    public function failedValidation(Validator $validator)
    {
        
        $error = $validator->errors()->toArray();

        if ( isset($error['location']) ) {
            $msg = $error['location'][0];
            $field = 'location';
            $code = 5001;
        } elseif ( isset($error['lat']) ) {
            $msg = $error['lat'][0];
            $field = 'lat';
            $code = 5002;
        } elseif ( isset($error['lng']) ) {
            $msg = $error['lng'][0];
            $field = 'lng';
            $code = 5003;
        } else {
            $msg = __('api.error');
            $code = 5000;
        }

        throw new HttpResponseException(response()->withError($msg, $code, $field));
    }
}
