<?php

namespace App\Http\Requests\Admin\Insurance;

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
            'company' => 'required|numeric',
            'vehicle' => 'required|numeric',
            'policy_number' => 'required|numeric',
            'charge_payable' => 'required|numeric',
            'start_date' => 'date',
            'end_date' => 'date',
            'recurring_date' => 'date',
        ];
    }
}
