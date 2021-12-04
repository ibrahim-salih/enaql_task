<?php

namespace App\Http\Requests\Admin\Role;

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
            'name' => 'required|string|unique:roles,name',
            'permissions.*' => 'required',
        ];
    }

    public function messages(){
        return [
            'name.required' => __('admin.role_validation_required'),
            'name.unique' => __('admin.role_validation_unique'),
        ];
    }
}
