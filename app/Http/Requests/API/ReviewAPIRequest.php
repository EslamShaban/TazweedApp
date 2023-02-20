<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;

class ReviewAPIRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'rate'          => ['required', 'numeric', 'min:1', 'max:5'],
            'review'        => ['nullable', 'string']
        ];
    }

        
    public function attributes()
    {
        return[
                        
            'rate'          => __('api.rate'),
            'review'        => __('api.review')

        ];
        
    }

    public function failedValidation(Validator $validator)
    {
        
        $error = $validator->errors()->toArray();

        if ( isset($error['rate']) ) {
            $msg = $error['rate'][0];
            $field = 'rate';
            $code = 5001;
        } elseif( isset($error['review']) ) {
            $msg = $error['review'][0];
            $field = 'review';
            $code = 5002;
        } else {
            $msg = __('api.error');
            $field = null;
            $code = 5000;
        }

        throw new HttpResponseException(response()->withError($msg, $code, $field));
    }
}
