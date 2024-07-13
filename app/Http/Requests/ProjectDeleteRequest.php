<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectDeleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //allow all logged in users for now
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
            'project_name' => ['required','string','max:255'],
            'confirm_delete' => ['required']
        ];
    }

    public function messages(): array
    {
        return [
            'project_name.required' => 'The project name is required.',
            'project_name.string' => 'The project name must be a string.',
            'confirm_delete' => 'You must confirm that this action cannot be undone.'
        ];
    }
}
