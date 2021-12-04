<?php

namespace App\Http\Requests\Admin\Purchase;

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
            'vendor' => 'required',
            'invoice' => 'required',
            'manual_requisition_image' => 'image|mimes:png,jpg,jpeg',
            'manual_requisition_image' => 'image|mimes:png,jpg,jpeg',
            'category_name.0' => 'required',
            'item_name.0' => 'required',
            'item_unit.0' => 'required',
            'unit_price.0' => 'required',
            'total_amount.0' => 'required',
        ];
    }
}
