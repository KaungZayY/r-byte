<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SprintRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }


    public function rules(): array
    {
        return [
            'sprint_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sprint_start_date' => 'required|date',
            'sprint_end_date' => 'required|date|after_or_equal:start_date'
        ];
    }

    public function messages(): array
    {
        return [
            'sprint_name.required' => 'The sprint name is required.',
            'sprint_start_date.required' => 'The start date is required.',
            'sprint_end_date.required' => 'The end date is required.',
            'sprint_end_date.after_or_equal' => 'The end date must be a date after or equal to the start date.'
        ];
    }
}
