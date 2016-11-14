<?php

namespace App\Http\Requests\Form;

use App\Http\Requests\Request;

class UserForm extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'                  => 'required',
            'email'                 => 'required',
            'password'              => 'required|confirmed',
            'password_confirmation' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required'                  => '用户名称不能为空',
            'email.required'                 => '用户邮箱不能为空',
            'password.required'              => '用户密码不能为空',
            'password.confirmed'             => '确认密码不一致',
            'password_confirmation.required' => '确认密码不能为空'
        ];
    }

}
