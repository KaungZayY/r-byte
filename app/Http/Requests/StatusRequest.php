<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
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
            'status' => 'required|string|max:255',
            'description' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'The project name is required.',
            'status.max' => 'The role name must not exceed 255 characters.',
            'status.string' => 'The role name must be a valid string.',
            'description.string' => 'The description must be a valid string.'
        ];
    }
}
