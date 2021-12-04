<?php

namespace App\Http\Requests\Admin\DriverPerformance;

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
            'driver' => 'required|numeric',
            'penalty_amount' => 'required|numeric',
            'over_time_status' => 'required',
            'salary_status' => 'required',
            'penalty_reason' => 'required',
            'overtime_payment' => 'required|numeric',
            'penalty_date' => 'nullable|date',
            'performance_bonus' => 'required|numeric',
        ];
    }
}
