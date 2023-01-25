<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CaptainRequest extends FormRequest
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
            'f_name'        => ['required', 'string'],
            'l_name'        => ['required', 'string'],
            'email'         => ['required', 'email', 'unique:users'],
            'password'      => ['required'],
            'image'         => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif'],
            'city_id'       => ['required', 'exists:cities,id'],
            'phone'         => ['required', 'string'],
            'plate_number'  => ['required', 'string']
        ];

     }
         
     /**
     *  validation rules that apply to the Update request
     * 
     *  @return array
     */

    protected function onUpdate(){

        return [
            'f_name'        => ['required', 'string'],
            'l_name'        => ['required', 'string'],
            'email'         => ['required', 'email', 'unique:users,email,' . $this->captain->id],
            'password'      => ['nullable'],
            'image'         => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif'],
            'city_id'       => ['required', 'exists:cities,id'],
            'phone'         => ['required', 'string', 'digits:11'],
            'plate_number'  => ['required', 'string']
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
            'image'         => 'الصورة',
            'city_id'       => 'المدينة'
        ];
        
    }
}
