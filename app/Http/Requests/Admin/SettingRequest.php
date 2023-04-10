<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules = [
            'app_logo'  => ['image', 'mimes:jpg,jpeg,png,gif,svg', 'nullable'],
            'service_price' => ['required'],
            'delivery_price' => ['required'],
            'tax' => ['required']
        ];

        
        return $rules;
    }

    public function attributes()
    {
        return[
            'app_logo'  => __('admin.app_logo'),
            'service_price'  => __('admin.service_price'),
            'delivery_price'  => __('admin.delivery_price'),
            'tax'  => __('admin.tax')
        ];
        
    }
}
