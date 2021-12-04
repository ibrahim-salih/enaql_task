<?php

namespace App\Http\Requests\Maintenance;

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
            'requisition_type' => 'required',
            'requisition_for' => 'required',
            'vehicle' => 'required',
            'maintenance_type' => 'required',
            'service_name' => 'required',
            'priority' => 'required',
            'service_date' => 'required',
            'item_type_name' => 'array',
            'item_type_name.0' => 'required',
            'item_unit' => 'array',
            'item_unit.0' => 'required',
            'unit_price' => 'array',
            'unit_price.0' => 'required',
            'total_amount' => 'array',
            'total_amount.0' => 'required',
        ];
    }
}
