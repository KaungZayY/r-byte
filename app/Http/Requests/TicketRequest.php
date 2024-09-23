<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{

    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'ticket_name' => 'required|string|max:255',
            'sprint_id' => 'required|exists:sprints,id|numeric',
            'duration_in_hour' => 'nullable|integer|required_without:duration_in_minutes',
            'duration_in_minutes' => 'nullable|integer|required_without:duration_in_hour',
            'description' => 'nullable|max:512'
        ];
    }

    public function messages(): array
{
    return [
        'ticket_name.required' => 'The ticket name is required.',
        'ticket_name.string' => 'The ticket name must be a valid string.',
        'ticket_name.max' => 'The ticket name cannot exceed 255 characters.',
        
        'sprint_id.required' => 'The sprint ID is required.',
        'sprint_id.exists' => 'The selected sprint ID is invalid.',
        
        'duration_in_hour.integer' => 'The duration in hours must be an integer value.',
        'duration_in_hour.required_without' => 'Provide approximate duration in hour.',
        
        'duration_in_minutes.integer' => 'The duration in minutes must be an integer value.',
        'duration_in_minutes.required_without' => 'Provide approximate duration in minutes.',
        
        'description.max' => 'The description cannot exceed 512 characters.',
    ];
}

}
