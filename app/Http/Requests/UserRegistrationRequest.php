<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistrationRequest extends FormRequest
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
            'firstname'=>'required|max:100',
             'lastname'=>'required|max:100',
             'cust_phone' => 'required|regex:/(08)[0-9]{8,12}/',
             'cust_email' => 'required|email|unique:m_customer,cust_email',
             'cust_password'=>'required|confirmed'
        ];
    }

    public function attributes()
    {
        return [
            'firstname' => 'Nama Depan',
            'lastname' => 'Nama Belakang',
            'cust_phone' => 'Nomor HP',
            'cust_email' => 'Email',
            'cust_password' => 'Password',
        ];
    }
}
