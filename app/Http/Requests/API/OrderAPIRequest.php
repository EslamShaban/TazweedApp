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
            'coupon_code'               => ['nullable'],
            'cart_items'                => ['required', 'array'],
            'cart_items.*.product_id'   => ['required', 'exists:products,id'],
            'cart_items.*.qty'          => ['required']
        ];
    }


         
    public function attributes()
    {
        return[
            'shipping_address_id' => __('api.shipping_address_id'),
            'coupon_code'   => __('api.coupon_code'),
            'cart_items'    => __('api.cart_items') 
        ];
        
    }

    public function failedValidation(Validator $validator)
    {
        
        $error = $validator->errors()->toArray();

        if( isset($error['shipping_address_id']) ) {
            $msg = $error['shipping_address_id'][0];
            $field = 'shipping_address_id';
            $code = 5001;
        } else if( isset($error['coupon_code']) ) {
            $msg = $error['coupon_code'][0];
            $field = 'coupon_code';
            $code = 5002;
        } else if( isset($error['cart_items']) ) {
            $msg = $error['cart_items'][0];
            $field = 'cart_items';
            $code = 5003;
        }  else {
            $error_codes = ["product_id"=>5004, "qty"=>5005];
            $msg = $validator->errors()->first();
            $code = $error_codes[explode('.', array_keys($validator->errors()->toArray())[0])[2]];
            $field = array_keys($validator->errors()->toArray())[0];
        }

        throw new HttpResponseException(response()->withError($msg, $code, $field));
    }
}
