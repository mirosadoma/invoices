<?php

namespace App\Http\Requests\Dashboard\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    // protected $errorBag = 'form';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required|min:6|max:30',
            'email'         => 'required|unique:users|email',
            'phone'         => 'required|min:9|max:15|unique:users,phone',
            'password'      => 'required|min:6|max:30',
            // 'image'         => 'required|image',
        ];
    }
}
