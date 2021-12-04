<?php

namespace App\Http\Requests\Admin\FuelType;

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
            'name' => 'required|unique:fuel_types,name'
        ];
    }
}