<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can(['manage users']);
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
            'user.role' => Rule::requiredIf($this->user()->can(['manage heads'])),
            'user.filial' => Rule::requiredIf($this->user()->can(['manage heads'])),
            'user.password' => 'confirmed',
        ];
    }
}
