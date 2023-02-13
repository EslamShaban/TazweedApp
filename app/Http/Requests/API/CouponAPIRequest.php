<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CouponAPIRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'coupon_code'   => ['required', 'string'],
            'product_id'    => ['nullable', 'exists:products,id'],
            'total_price'   => ['required']
        ];
    }


         
    public function attributes()
    {
        return[

            'coupon_code'   => __('api.coupon_code'),
            'product_id'    => __('api.product'),
            'total_price'   => __('api.total_price')
        ];
        
    }

    public function failedValidation(Validator $validator)
    {
        
        $error = $validator->errors()->toArray();

        if ( isset($error['coupon_code']) ) {
            $msg = $error['coupon_code'][0];
            $field = 'coupon_code';
            $code = 5001;
        } elseif ( isset($error['product_id']) ) {
            $msg = $error['product_id'][0];
            $field = 'product_id';
            $code = 5002;
        } elseif ( isset($error['total_price']) ) {
            $msg = $error['total_price'][0];
            $field = 'total_price';
            $code = 5003;
        } else {
            $msg = __('api.error');
            $code = 5000;
        }

        throw new HttpResponseException(response()->withError($msg, $code, $field));
    }
}
