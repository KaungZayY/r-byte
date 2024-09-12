<?php

namespace App\Livewire;

use App\Models\Status;
use App\Models\Ticket;
use Livewire\Component;

class TicketBoard extends Component
{
    public $project;
    public $sprint;

    public function render()
    {
        $sprint = $this->sprint;
        $statuses = $this->project->statuses()->orderBy('position')->get();
        $tickets = $sprint->tickets()->orderBy('position','DESC')->get();
        return view('livewire.ticket-board',compact('statuses','tickets','sprint'));
    }
}
