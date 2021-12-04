<?php

namespace App\Http\Requests\Admin\Vehicle;

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
            'name' => 'required|string',
            'vehicle_type' => 'required|numeric',
            'department' => 'required|numeric',
            'vehicle_division' => 'required|numeric',
            'registration_date' => 'required|date',
            'office' => 'required|numeric',
            'license_plate' => 'required',
            'driver' => 'required|numeric',
            'purchase_date' => 'required|date',
            'alert_email' => 'required|email',
            'seat_capacity' => 'required|numeric',
            'ownership' => 'required',
            'insurance_type' => 'required',
            'insurance_company' => 'required',
            'insurance_start_date' => 'required',
            'rent_from' => 'nullable',
            'rent_price' => 'nullable',
        ];
    }
}
