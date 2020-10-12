<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can(['manage users', 'manage heads']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user.name' => 'required|max:255',
            'user.email' => 'required|email|unique:users,email,'.$this->user['id'],
            'user.role' => 'required',
            'user.filial' => 'required',
            'user.password' => 'confirmed',
        ];
    }
}
