<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ShippingAddressAPIRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'        => ['required', 'string'],
            'phone'       => ['required', 'string'],
            'city_id'     => ['required', 'exists:cities,id'],
            'address'     => ['required', 'string']
        ];
    }


         
    public function attributes()
    {
        return[

            'name'        => __('api.name'),
            'phone'       => __('api.phone'),
            'city_id'     => __('api.city'), 
            'address'     => __('api.address')
        ];
        
    }

    public function failedValidation(Validator $validator)
    {
        
        $error = $validator->errors()->toArray();

        if ( isset($error['name']) ) {
            $msg = $error['name'][0];
            $field = 'name';
            $code = 5001;
        } elseif ( isset($error['phone']) ) {
            $msg = $error['phone'][0];
            $field = 'phone';
            $code = 5002;
        } elseif ( isset($error['city_id']) ) {
            $msg = $error['city_id'][0];
            $field = 'city_id';
            $code = 5003;
        } elseif ( isset($error['city_id']) ) {
            $msg = $error['city_id'][0];
            $field = 'city_id';
            $code = 5004;
        } elseif ( isset($error['address']) ) {
            $msg =  $error['address'][0];
            $field = 'address';
            $code = 5005;
        } else {
            $msg = __('api.error');
            $code = 5000;
        }

        throw new HttpResponseException(response()->withError($msg, $code, $field));
    }
}
