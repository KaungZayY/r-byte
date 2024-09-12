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
        $project = $this->project;
        $statuses = $project->statuses()->orderBy('position')->get();
        $tickets = $sprint->tickets()->orderBy('position')->get();
        return view('livewire.ticket-board',compact('statuses','tickets','sprint','project'));
    }

    public function updateStatusOrder($groupedStatuses)
    {
        foreach ($groupedStatuses as $statusOrder) {
            $status = Status::find($statusOrder['value']);
            $status->update(['position' => $statusOrder['order']]);
        }
    }

    public function updateTicketOrder($groupedTickets)
    {
        foreach ($groupedTickets as $group) {
            $statusId = $group['value'];
            foreach ($group['items'] as $ticketOrder) {
                $ticket = Ticket::find($ticketOrder['value']);
                $ticket->update([
                    'status_id' => $statusId,
                    'position' => $ticketOrder['order'],
                ]);
            }
        }
    }
}
