<?php

namespace App\Http\Requests\Admin\Requisition;

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
            'vehicle_type' => 'required|numeric',
            'client_to' => 'required',
            'where_to' => 'where_to',
            'tolerance_duration' => 'required',
            'driven_by' => 'required|numeric',
            'purpose' => 'required',
            'details' => 'required',
        ];
    }
}
