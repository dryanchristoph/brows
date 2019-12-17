<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
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
            'cust_email'  => 'required|email|max:100|exists:m_customer,cust_email',
            'cust_password'  => 'required|max:100'
        ];
    }

    public function attributes()
    {
        return [
            'cust_email' => 'Email',
            'cust_password' => 'Password'
        ];
    }
}
