<?php

namespace App\Http\Requests\Admin\Expense;

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
            'expense_category' => 'required',
            'by_whom' => 'required',
            'vehicle' => 'required',
            'trip_type' => 'required',
            'trip_number' => 'required',
            'odometer' => 'required',
            'expense_date' => 'required',
            'invoice' => 'required',
            'rent_vehicle_cost' => 'required',
        ];
    }
}
