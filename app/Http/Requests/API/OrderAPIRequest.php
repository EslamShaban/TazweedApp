<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class OrderAPIRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'shipping_address_id'       => ['required'],
            
            'cart_items'                => ['required', 'array'],
            'cart_items.*.product_id'   => ['required', 'exists:products,id'],
            'cart_items.*.qty'          => ['required']
        ];
    }


         
    public function attributes()
    {
        return[

            'cart_items'   => __('api.cart_items') 

        ];
        
    }

    public function failedValidation(Validator $validator)
    {
        
        $error = $validator->errors()->toArray();

        if( isset($error['cart_items']) ) {
            $msg = $error['cart_items'][0];
            $code = 5001;
            $field = 'cart_items';
        } else {
            $error_codes = ["product_id"=>5002,"qty"=>5003];
            $msg = $validator->errors()->first();
            $code = $error_codes[explode('.', array_keys($validator->errors()->toArray())[0])[2]];
            $field = array_keys($validator->errors()->toArray())[0];
        }

        throw new HttpResponseException(response()->withError($msg, $code, $field));
    }
}