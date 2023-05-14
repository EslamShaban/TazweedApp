<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'image'                 => ['required', 'image', 'mimes:jpg,jpeg,png,gif'],
            'category_id'           => ['required', 'exists:categories,id'],
            'price'                 => ['required'],
            'is_offer'              => ['nullable', 'boolean'],
            'discount_price'        => ['nullable', 'required_if:offer,1'],
            'car_type_id'           => ['required', 'exists:car_types,id'],
            'car_model_ids'         => ['required', 'array'],
            'car_model_ids.*'       => ['exists:car_models,id'],
            'type'                  => ['required', 'in:original,high-copy,copy'],
            'manufacturing_year'    => ['required'],
            'manufacture_country'   => ['required', 'exists:countries,id'],

        ];

        foreach(config('translatable.locales') as $locale){
            $rules+=[$locale . '.name' => ['required', 'string']];
            $rules+=[$locale . '.desc' => ['required', 'string']];
            $rules+=[$locale . '.features' => ['nullable', 'array']];
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
            'image'                 => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif'],
            'category_id'           => ['required', 'exists:categories,id'],
            'price'                 => ['required'],
            'is_offer'              => ['nullable', 'boolean'],
            'discount_price'        => ['nullable', 'required_if:offer,1'],
            'car_type_id'           => ['required', 'exists:car_types,id'],
            'car_model_ids'         => ['required', 'array'],
            'car_model_ids.*'       => ['exists:car_models,id'],
            'type'                  => ['required', 'in:original,high-copy,copy'],
            'manufacturing_year'    => ['required'],
            'manufacture_country'   => ['required', 'exists:countries,id'],
        ];

        foreach(config('translatable.locales') as $locale){
            $rules+=[$locale . '.name' => ['required', 'string']];
            $rules+=[$locale . '.desc' => ['required', 'string']];
            $rules+=[$locale . '.features' => ['nullable', 'array']];
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
            'image'                 => __('admin.image'),
            'ar.name'               => __('admin.ar.product_name'),
            'en.name'               => __('admin.en.product_name'),
            'ar.desc'               => __('admin.ar.product_desc'),
            'en.desc'               => __('admin.en.product_desc'),
            'category_id'           => __('admin.category'),
            'price'                 => __('admin.price'),
            'discount_price'        => __('admin.discount_price'),
            'car_type_id'           => __('admin.car_type'),
            'car_model_ids'         => __('admin.car_model'),
            'manufacture_country'   => __('admin.manufacture_country'),
            'type'                  => __('admin.type'),
            'manufacturing_year'    => __('admin.manufacturing_year'),
            'ar.features'           => __('admin.ar.features'),
            'en.features'           => __('admin.en.features'),
        ];
        
    }
}
