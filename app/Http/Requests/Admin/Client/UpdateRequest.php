<?php

namespace App\Http\Requests\Admin\Client;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'nullable|email|unique:users,email,' . $this->route('client'),
            'password' => 'nullable|confirmed',
            'bank_account_number' => 'required',
            'company_name' => 'required',
            'phone' => 'required',
            'mobile' => 'required',
            'commercial_number' => 'required',
            'address' => 'required',

        ];
    }
}
