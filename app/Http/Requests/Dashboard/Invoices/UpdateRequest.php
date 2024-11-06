<?php

namespace App\Http\Requests\Dashboard\Invoices;

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
            'currance'              => __('Currance'),
            'status'                => __('Status'),
            'project_id'            => __('Project'),
            'user_type'             => __('User Type'),
            'user_id'               => __('Person'),
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
            'currance'              => 'required|string|in:USD,EGP,SAR,AED',
            // 'status'                => 'required|string|in:paid,unpaid,in_process',
            'status'                => 'required|string|in:paid,unpaid',
            'project_id'            => 'required|exists:projects,id|not_in:null,0',
            'user_type'             => 'required|string|in:client,freelancer',
            'user_id'               => 'required|exists:users,id|not_in:null,0',
        ];
    }
}
