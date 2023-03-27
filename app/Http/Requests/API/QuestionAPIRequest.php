<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class QuestionAPIRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'request_id'                => ['required', 'exists:wash_requests,id'],
            'questions'                 => ['required', 'array'],
            'questions.*.question_id'   => ['required', 'exists:questions,id'],
            'questions.*.answer'        => ['required', 'in:yes,no']
        ];
    }


         
    public function attributes()
    {
        return[
            'request_id' => __('api.request_id'),
            'questions'  => __('api.questions') 
        ];
        
    }

    public function failedValidation(Validator $validator)
    {
        
        $error = $validator->errors()->toArray();

        if( isset($error['request_id']) ) {
            $msg = $error['request_id'][0];
            $field = 'request_id';
            $code = 5001;
        } else if( isset($error['questions']) ) {
            $msg = $error['questions'][0];
            $field = 'questions';
            $code = 5002;
        }  else {
            $error_codes = ["question_id"=>5003, "answer"=>5004];
            $msg = $validator->errors()->first();
            $code = $error_codes[explode('.', array_keys($validator->errors()->toArray())[0])[2]];
            $field = array_keys($validator->errors()->toArray())[0];
        }

        throw new HttpResponseException(response()->withError($msg, $code, $field));
    }
}
