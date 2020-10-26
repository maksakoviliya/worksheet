<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUser extends FormRequest
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
            'user.email' => 'required|email|unique:users,email',
            'user.role' => Rule::requiredIf($this->user()->can(['manage heads'])),
            'user.filial' => Rule::requiredIf($this->user()->can(['manage heads']) && $this->user['role'] !== 'admin'),
            'user.password' => 'required|confirmed',
            'user.password_confirmation' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'user.email.unique' => 'Поле \'Email\' должно быть уникальным',
        ];
    }
}
