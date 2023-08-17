<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
            'start_date'            => ['required'],
            'end_date'              => ['required'],
            'discount_type'         => ['required'],
            'discount_amount'       => ['required'],
            'model_type'            => ['required'],
            'model_id'              => ['required', 'array'],
        ];

        foreach(config('translatable.locales') as $locale){
            $rules+=[$locale . '.name' => ['required', 'string', 'unique:offer_translations,name']];
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
            'start_date'            => ['required'],
            'end_date'              => ['required'],
            'discount_type'         => ['required'],
            'discount_amount'       => ['required'],
            'model_type'            => ['required'],
            'model_id'              => ['required', 'array'],
        ];

        foreach(config('translatable.locales') as $locale){
            $rules+=[$locale . '.name' => ['required', 'string', 'unique:offer_translations,name,' . $this->offer->id . ',offer_id']];
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

     public function offers()
    {
        return[
            'ar.name'     => __('admin.ar.offer_name'),
            'en.name'     => __('admin.en.offer_name'),
            'start_date'     => __('admin.start_date'),
            'end_date'     => __('admin.end_date'),
            'discount_type'     => __('admin.discount_type'),
            'discount_amount'     => __('admin.discount_amount'),
            'model_type'     => __('admin.model_type'),
            'model_id'     => __('admin.model_id'),
        ];

    }
}
