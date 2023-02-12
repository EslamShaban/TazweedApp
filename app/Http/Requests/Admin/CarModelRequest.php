<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CarModelRequest extends FormRequest
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
            $rules+=[$locale . '.model' => ['required', 'string', 'unique:car_model_translations,model']];
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
            $rules+=[$locale . '.model' => ['required', 'string', 'unique:car_model_translations,model,' . $this->car_model->id . ',car_model_id']];
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
            'ar.model'          => __('admin.ar.car_model'),
            'en.model'          => __('admin.en.car_model'),
        ];
        
    }
}
