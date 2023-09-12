<?php

namespace App\Http\Requests\Dashboard\Projects;

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
        return true;
    }

    public function attributes()
    {
        return [
            'name'                  => __('Name'),
            'logo'                  => __('Logo'),
            'client_id'             => __('Client'),
            'details'               => __('Details'),
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
            'name'                  => 'required|string|between:2,100',
            'logo'                  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'client_id'             => 'required|exists:users,id|not_in:null,0',
            'details'               => 'required|string|between:2,5000000',
        ];
    }
}
