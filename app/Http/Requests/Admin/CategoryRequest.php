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

        return [
            'name'        => ['required', 'string', 'unique:categories,name'],
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif']
        ];

     }
         
     /**
     *  validation rules that apply to the Update request
     * 
     *  @return array
     */

    protected function onUpdate(){

        return [
            'name'        => ['required', 'string', 'unique:categories,name,' . $this->category->id],
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif']
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
            'f_name'        => 'الإسم الاول',
            'l_name'        => 'الإسم الاخير',
            'email'         => 'البريد الالكتروني',
            'password'      => 'كلمة المرور',
            'role_id'       => 'الصلاحية',
            'image'         => 'الصورة'
        ];
        
    }
}
