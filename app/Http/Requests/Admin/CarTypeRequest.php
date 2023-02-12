<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CarTypeRequest extends FormRequest
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
  
        $rules = [];

        foreach(config('translatable.locales') as $locale){
            $rules+=[$locale . '.type' => ['required', 'string', 'unique:car_type_translations,type']];
        }

        return $rules;
     }
         
     /**
     *  validation rules that apply to the Update request
     * 
     *  @return array
     */

    protected function onUpdate(){
    
        $rules = [];

        foreach(config('translatable.locales') as $locale){
            $rules+=[$locale . '.type' => ['required', 'string', 'unique:car_type_translations,type,' . $this->car_type->id . ',car_type_id']];
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
            'ar.type'          => __('admin.ar.car_type'),
            'en.type'          => __('admin.en.car_type'),
        ];
        
    }
}
