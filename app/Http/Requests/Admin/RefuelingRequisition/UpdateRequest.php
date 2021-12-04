<?php

namespace App\Http\Requests\Admin\RefuelingRequisition;

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
            'vehicle' => 'required|numeric',
            'fuel_type' => 'required|numeric',
            'station' => 'required|numeric',
            'quantity' => 'required|numeric',
            'current_odometer' => 'required|numeric',
        ];
    }
}
