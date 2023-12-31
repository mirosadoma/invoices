<?php

namespace App\Http\Requests\Dashboard\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateRequest extends FormRequest
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
        $return = [
            'name'        => 'required|min:6|max:30',
            'email'       => 'required|email|unique:users,email,'.$this->admin->id,
            'phone'       => 'required|min:9|max:15|unique:users,phone,'.$this->admin->id,
        ];
        if(request()->has('password')) {
            $return['password'] = 'required|min:6|max:30';
        }
        if(request()->has('image')) {
            $return['image'] = 'required|image';
        }
        return $return;
    }
}
