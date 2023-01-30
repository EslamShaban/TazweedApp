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

        return [
            'model'        => ['required', 'string', 'unique:car_models,model']
        ];

     }
         
     /**
     *  validation rules that apply to the Update request
     * 
     *  @return array
     */

    protected function onUpdate(){

        return [
            'model'        => ['required', 'string', 'unique:car_models,model,' . $this->car_model->id]
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
            'model'        => 'موديل السيارة'
        ];
        
    }
}
