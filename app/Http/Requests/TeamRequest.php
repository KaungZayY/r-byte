<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
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
            'team_name' => 'required|string|max:55',
            'description' => 'nullable|max:512'
        ];
    }

    public function message(): array
    {
        return [
            'team_name.required' => 'The name is required.',
            'team_name.max:55' => 'Team name exceeded maximum word limit.',
            'description.max:512' => 'The description exceeded maximum word limit.'
        ];
    }
}
