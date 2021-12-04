<?php

namespace App\Http\Requests\Admin\ApprovalAuthority;

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
            'requisition_type' => 'required|numeric',
            'department' => 'required|numeric',
            'requisition_phase' => 'required',
        ];
    }
}
