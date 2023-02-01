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

        return [
            'image'       => ['required', 'image', 'mimes:jpg,jpeg,png,gif'],
            'name'        => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'desc'        => ['required', 'string'],
            'price'       => ['required'],
            'discount_price' => ['nullable'],
            'car_type_id' => ['required', 'exists:car_types,id'],
            'car_model_ids' => ['required', 'array'],
            'car_model_ids.*' => ['exists:car_models,id'],
            'manufacture_country' => ['required', 'string'],
            'type'  => ['required', 'in:original,high-copy,copy'],
            'manufacturing_year' => ['required'],
            'features'  => ['nullable', 'array']
        ];

     }
         
     /**
     *  validation rules that apply to the Update request
     * 
     *  @return array
     */

    protected function onUpdate(){

        return [
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif'],
            'name'        => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'desc'        => ['required', 'string'],
            'price'       => ['required'],
            'discount_price' => ['nullable'],
            'car_type_id' => ['required', 'exists:car_types,id'],
            'car_model_ids' => ['required', 'array'],
            'car_model_ids.*' => ['exists:car_models,id'],
            'manufacture_country' => ['required', 'string'],
            'type'  => ['required', 'in:original,high-copy,copy'],
            'manufacturing_year' => ['required'],
            'features'  => ['nullable', 'array']
        ];

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
            'image'     => 'الصورة',
            'name'      => 'إسم المنتج',
            'category_id' => 'القسم',
            'desc'  => 'وصف المنتج',
            'price' => 'السعر',
            'discount_price' => 'سعر الخصم',
            'car_type_id' => 'نوع السيارة',
            'car_model_ids' => 'موديلات السيارة',
            'manufacture_country' => 'بلد المصنع',
            'type'  => 'الصنع',
            'manufacturing_year' => 'سنة الصنع',
            'features'  => 'المميزات'
        ];
        
    }
}
