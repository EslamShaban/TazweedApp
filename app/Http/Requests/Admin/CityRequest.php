<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
            $rules+=[$locale . '.name' => ['required', 'string', 'unique:city_translations,name']];
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
            $rules+=[$locale . '.name' => ['required', 'string', 'unique:city_translations,name,' . $this->city->id . ',city_id']];
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
            'ar.name'          => __('admin.ar.city_name'),
            'en.name'          => __('admin.en.city_name'),
        ];
    }
}
