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
            'duration' => 'required|integer',
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
        
        'duration.required' => 'The duration is required.',
        'duration.integer' => 'The duration must be an integer value (in minutes).',
        
        'description.max' => 'The description cannot exceed 512 characters.',
    ];
}

}
