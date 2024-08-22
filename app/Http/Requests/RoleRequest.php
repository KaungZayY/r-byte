<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'role_name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'role_name.required' => 'The project name is required.',
            'role_name.max' => 'The role name must not exceed 255 characters.',
            'role_name.string' => 'The role name must be a valid string.',
            'description.string' => 'The description must be a valid string.'
        ];
    }
}
