<?php

namespace App\Http\Requests\Dashboard\Admins;

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
            'name'                  => __('Admin Name'),
            'email'                 => __('Admin Email'),
            'phone'                 => __('Admin Phone'),
            // 'image'                 => __('Admin Image'),
            'password'              => __('Admin Password'),
            'password_confirmation' => __('Password Confirmation'),
            'role_name'             => __('Role Name')
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
            'role_name'             => 'required|not_in:null|exists:roles,name',
        ];
    }
}
