<?php

namespace App\Livewire;

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

    public function mount($ticket)
    {
        $this->ticket = $ticket;
    }

    public function render()
    {
        return view('livewire.detail-ticket');
    }
}
