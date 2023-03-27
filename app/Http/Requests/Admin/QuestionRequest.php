<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     *  validation rules that apply to the Create request
     * 
     *  @return 
     */

    protected function onCreate(){
    
        $rules = [
            'questionable_type'       => ['required'],
            'questionable_id'         => ['required']
        ];

        foreach(config('translatable.locales') as $locale){
            $rules+=[$locale . '.question' => ['required', 'string']];
        }

        return $rules;

     }
         
     /**
     *  validation rules that apply to the Update request
     * 
     *  @return array
     */

    protected function onUpdate(){

        $rules = [
            'questionable_type'       => ['required'],
            'questionable_id'         => ['required']
        ];

        foreach(config('translatable.locales') as $locale){
            $rules+=[$locale . '.question' => ['required', 'string']];
        }
        
        return $rules;

    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return request()->isMethod('put') || request()->isMethod('patch') ? 
        $this->onUpdate() : $this->onCreate();

    }

     public function attributes()
    {
        return[
            'ar.question'       => __('admin.ar.question'),
            'en.question'       => __('admin.en.question'),
            'questionable_type' => __('admin.questionable_type'),
            'questionable_id'   => __('admin.questionable_id')
        ];
        
    }
}
