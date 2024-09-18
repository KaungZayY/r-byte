<?php

namespace App\Livewire;

use App\Models\Ticket;
use Livewire\Component;

class DetailTicket extends Component
{
    public $ticket;
    public $backlog_id;
    public $project_id;
    public $sprint_id;
    public $ticket_name;
    public $status_id;
    public $position;
    public $duration;
    public $description;
    public $backlog_created_by;
    public $ticket_created_by;
    public $sprints;

    public function mount($ticket)
    {
        $this->ticket = $ticket;
        $this->sprints = $ticket->project->sprints;
    }

    public function render()
    {
        return view('livewire.detail-ticket');
    }

    public function destroy(Ticket $ticket)
    {
        $deleted = $ticket->delete();
        if(!$deleted){
            session()->flash('flash.banner', 'Action Failed.');
            session()->flash('flash.bannerStyle', 'danger');
        }
        else{
            session()->flash('flash.banner', 'Ticket Deleted.');
            session()->flash('flash.bannerStyle', 'success');
        }
        return redirect()->route('tickets', ['project' => $this->ticket->project,'sprint' => $this->ticket->sprint]);
    }
}
