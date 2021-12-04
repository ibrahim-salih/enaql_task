<?php

namespace App\Http\Requests\Admin\Requisition;

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
            'vehicle_type' => 'required|numeric',
            'client_to' => 'required',
            'tolerance_duration' => 'required',
            'driven_by' => 'required|numeric',
            'purpose' => 'required',
            'details' => 'required',
            'number_of_orders' => 'required',
            'place' => 'required',
            'client' => 'required',
        ];
    }
}
