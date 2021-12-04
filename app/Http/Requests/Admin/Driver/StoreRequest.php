<?php

namespace App\Http\Requests\Admin\Driver;

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
            'residency_number' => 'required',
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|numeric|unique:driver_data,mobile',
            'license_expiration_date' => 'required',
            'residency_expiration_date' => 'required',
            'passport_expiration_date' => 'required',
            'passport_number' => 'required',
            'health_insurance_date' => 'required',
            'residency_number' => 'required|numeric|unique:driver_data,residency_number',
            'driver_photograph' => 'image|mimes:png,jpg,jpeg',
            'bank_account_number' => 'required',
            'license_number' => 'required',
            'license_type_id' =>'required',
        ];
    }
}
