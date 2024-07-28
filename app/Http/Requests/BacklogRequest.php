<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BacklogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'backlog' => 'required|string|max:255',
            'description' => 'nullable|max:512'
        ];
    }

    public function messages(): array
    {
        return [
            'backlog.required' => 'The backlog is required.',
            'backlog.max:255' => 'Backlog exceeded maximum word limit.'
        ];
    }
}
