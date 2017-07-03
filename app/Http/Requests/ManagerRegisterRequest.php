<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManagerRegisterRequest extends FormRequest
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
        return [
            //
            'manager_account'=>'required|string',
            'manager_password'=>'required|string',
            'manager_again_password'=>'required|string|same:manager_password',
            'manager_Email'=>'required|email'
        ];
    }
    public function messages(){
        return[
            'manager_account.required'=>'管理員帳號的欄位是必要的。',
            'manager_password.required'=>'管理員密碼的欄位是必要的。',
            'manager_again_password.required'=>'密碼再確認的欄位是必要的。',
            'manager_Email.required'=>'管理員信箱的欄位是必要的。',
            'same'=>'密碼再確認跟密碼不相同',
            'email'=>'管理員信箱的欄位格式不符合E-mail'
        ];
    }
}
