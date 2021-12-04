<?php

namespace App\Http\Requests\Admin\Permission;

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
            'name' => 'required|string|unique:permissions,name'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'برجاء ادخال اسم الصلاحية',
            'name.unique' => 'هذه الصلاحية موجودة بالفعل',
        ];
    }
}
