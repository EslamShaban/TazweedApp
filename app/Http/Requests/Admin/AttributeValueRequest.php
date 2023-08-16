<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AttributeValueRequest extends FormRequest
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

        $rules = ['attribute_id'           => ['required', 'exists:attributes,id'],];

        foreach(config('translatable.locales') as $locale){
            $rules+=[$locale . '.name' => ['required', 'string', 'unique:attribute_value_translations,name']];
        }

        return $rules;

     }

     /**
     *  validation rules that apply to the Update request
     *
     *  @return array
     */

    protected function onUpdate(){

        $rules = ['attribute_id'           => ['required', 'exists:attributes,id'],];

        foreach(config('translatable.locales') as $locale){
            $rules+=[$locale . '.name' => ['required', 'string', 'unique:brand_translations,name,' . $this->brand->id . ',brand_id']];
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

     public function brands()
    {
        return[
            'ar.name'     => __('admin.ar.brand_name'),
            'en.name'     => __('admin.en.brand_name'),
            'attribute_id'           => __('admin.attribute'),
        ];

    }
}
