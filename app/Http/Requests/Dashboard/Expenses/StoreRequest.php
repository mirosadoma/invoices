<?php

namespace App\Http\Requests\Dashboard\Expenses;

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
        return true;
    }

    public function attributes()
    {
        return [
            'item'                  => __('Item'),
            'description'           => __('Description'),
            'price'                 => __('Price'),
            'status'                => __('Status'),
            'file'                  => __('File'),
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'item'                  => 'required|string|between:2,1000',
            'description'           => 'required|string|between:2,1000000',
            'price'                 => 'required|numeric|min:1',
            'status'                => 'required|string|in:on_hold,paid',
            'file'                  => 'nullable|in:pdf',
        ];
    }
}
