<?php

namespace App\Livewire;

use Livewire\Component;

class TicketBoard extends Component
{
    public $project;
    public $sprint;

    public function render()
    {
        $sprint = $this->sprint;
        $statuses = $this->project->statuses;
        $tickets = $sprint->tickets;
        return view('livewire.ticket-board',compact('statuses','tickets','sprint'));
    }
}
