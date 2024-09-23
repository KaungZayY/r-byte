<?php

namespace App\Livewire;

use App\Helpers\PermissionHelper;
use App\Models\Ticket;
use Livewire\Component;

class DetailTicket extends Component
{
    public $ticket;
    public $project;
    public $sprint_id;
    public $ticket_name;
    public $duration;
    public $description;
    public $sprints;
    public $default_sprint_id;

    protected $rules = [
        'ticket_name' => 'required|string|max:255',
        'sprint_id' => 'required|exists:sprints,id|numeric',
        'duration' => 'required|integer',
        'description' => 'nullable|max:512'
    ];

    protected $messages = [
        'ticket_name.required' => 'The ticket name is required.',
        'ticket_name.string' => 'The ticket name must be a valid string.',
        'ticket_name.max' => 'The ticket name cannot exceed 255 characters.',
        'sprint_id.required' => 'The sprint ID is required.',
        'sprint_id.exists' => 'The selected sprint ID is invalid.',
        'duration.required' => 'The duration is required.',
        'duration.integer' => 'The duration must be an integer value (in minutes).',
        'description.max' => 'The description cannot exceed 512 characters.',
    ];

    public function mount($ticket)
    {
        $this->ticket = $ticket;
        $this->project = $this->ticket->project;
        $this->sprints = $ticket->project->sprints;
        $this->ticket_name = $ticket->ticket_name;
        $this->sprint_id = $ticket->sprint_id;
        $this->default_sprint_id = $this->sprint_id;
        $this->duration = $ticket->duration;
        $this->description = $ticket->description;
    }

    public function render(PermissionHelper $pHelper)
    {
        $pHelper->authorizeUser($this->project,'Tickets','Detail');
        return view('livewire.detail-ticket');
    }

    public function update(PermissionHelper $pHelper)
    {
        $pHelper->authorizeUser($this->project,'Tickets','Update');
        $validated = $this->validate();
        try {

            $this->ticket->update($validated);

            session()->flash('flash.banner', 'Ticket Info Updated.');
            session()->flash('flash.bannerStyle', 'success');
        } catch (\Exception $e) {
            session()->flash('flash.banner', 'Cannot Update Ticket Info.');
            session()->flash('flash.bannerStyle', 'danger');
        }
        return redirect()->route('tickets', ['project' => $this->ticket->project,'sprint' => $this->default_sprint_id]);
    }

    public function destroy(Ticket $ticket, PermissionHelper $pHelper)
    {
        $pHelper->authorizeUser($this->project,'Tickets','Delete');
        $deleted = $ticket->delete();
        if(!$deleted){
            session()->flash('flash.banner', 'Action Failed.');
            session()->flash('flash.bannerStyle', 'danger');
        }
        else{
            session()->flash('flash.banner', 'Ticket Deleted.');
            session()->flash('flash.bannerStyle', 'success');
        }
        return redirect()->route('tickets', ['project' => $this->ticket->project,'sprint' => $this->default_sprint_id]);
    }
}
