<?php

namespace App\Http\Requests\Admin\Empolyee;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'employee_nid' => 'required|unique:employee_data,NID',
            'pay_roll_type' => 'required',
            'designation' => 'required|numeric',
            'department' => 'required|numeric',
            'mobile' => 'required|numeric',
            'email' => 'required|email|unique:users,email',
            'mobile_optional' => 'numeric|nullable',
            'email_optional' => 'email|nullable',
            'join_date' => 'date|required',
            'blood_group' => 'required',
            'date_of_birth' => 'required|date',
            'bank_account_number' => 'required',
            'roles_name' => 'required'
        ];
    }
}
