<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif']
        ];

        foreach(config('translatable.locales') as $locale){
            $rules+=[$locale . '.name' => ['required', 'string', 'unique:category_translations,name']];
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
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif']
        ];

        foreach(config('translatable.locales') as $locale){
            $rules+=[$locale . '.name' => ['required', 'string', 'unique:category_translations,name,' . $this->category->id . ',category_id']];
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
            'ar.name'     => __('admin.ar.category_name'),
            'en.name'     => __('admin.en.category_name'),
            'image'       => __('admin.image')
        ];
        
    }
}
