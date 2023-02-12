<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'coupon_code'           => ['required'],
            'discount_type'         => ['required'],
            'discount_amount'       => ['nullable', 'required_if:discount_type,amount'],
            'discount_percentage'   => ['nullable', 'required_if:discount_type,percentage'],
            'start_date'            => ['required'],
            'end_date'              => ['required']
        ];

        foreach(config('translatable.locales') as $locale){
            $rules+=[$locale . '.title' => ['required']];
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
            'coupon_code'           => ['required'],
            'discount_type'         => ['required'],
            'discount_amount'       => ['nullable', 'required_if:discount_type,amount'],
            'discount_percentage'   => ['nullable', 'required_if:discount_type,percentage'],
            'start_date'            => ['required'],
            'end_date'              => ['required']
        ];

        foreach(config('translatable.locales') as $locale){
            $rules+=[$locale . '.title' => ['required']];
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
            'ar.title'              => __('admin.ar.coupon_title'),
            'en.title'              => __('admin.en.coupon_title'),
            'coupon_code'           => __('admin.coupon_code'),
            'coupon_type'           => __('admin.coupon_type'),
            'discount_type'         => __('admin.discount_type'),
            'discount_amount'       => __('admin.amount'),
            'discount_percentage'   => __('admin.percentage'),
            'start_date'            => __('admin.start_date'),
            'end_date'              => __('admin.end_date')
        ];
    }
}
