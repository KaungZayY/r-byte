<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{

    public function authorize(): bool
    {
        //allow all logged in users for now
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'project_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ];
    }

    public function messages(): array
    {
        return [
            'project_name.required' => 'The project name is required.',
            'start_date.required' => 'The start date is required.',
            'end_date.required' => 'The end date is required.',
            'end_date.after_or_equal' => 'The end date must be a date after or equal to the start date.'
        ];
    }
}
