<?php

namespace App\Http\Requests\Admin\Part;

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
            'name' => 'required|unique:parts,name,' . $this->route('part'),
            'category' => 'required',
            'stock_limit' => 'required',
            'location' => 'required',
        ];
    }
}
