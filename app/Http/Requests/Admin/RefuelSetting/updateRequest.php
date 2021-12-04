<?php

namespace App\Http\Requests\Admin\RefuelSetting;

use Illuminate\Foundation\Http\FormRequest;

class updateRequest extends FormRequest
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
            'vehicle' => 'required',
            'driver' => 'required',
            'fuel_type' => 'required',
            'station' => 'required',
            'driver_mobile' => 'required|numeric',
            'max_unit' => 'required|numeric',
            'budget_given' => 'required|numeric',
            'place' => 'required',
            'kilometer_per_unit' => 'required|numeric',
        ];
    }
}
