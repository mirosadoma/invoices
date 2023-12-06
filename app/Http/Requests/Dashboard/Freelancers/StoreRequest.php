<?php

namespace App\Http\Requests\Dashboard\Freelancers;

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
            'name'                  => __('Name'),
            'email'                 => __('Email'),
            'phone'                 => __('Phone'),
            // 'image'                 => __('Image'),
            'password'              => __('Password'),
            'password_confirmation' => __('Password Confirmation'),
            'country_id'            => __('Country'),
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
            'email'                 => 'required|email:filter|between:2,200|unique:users,email',
            'phone'                 => 'required|min:9|max:15|unique:users,phone',
            // 'image'                 => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'password'              => 'required|between:6,255',
            'password_confirmation' => 'required_with:password|same:password',
            'country_id'            => 'required|exists:countries,id|not_in:null,0',
        ];
    }
}
