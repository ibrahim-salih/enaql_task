<?php

namespace App\Http\Requests\Admin\PickDropRequisition;

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
            'route' => 'required|numeric',
            'requisition_for' => 'required|numeric',
            'requisition_type' => 'required|numeric',
            'start_point' => 'required',
            'end_point' => 'required',
            'request_type' => 'required',
        ];
    }
}
