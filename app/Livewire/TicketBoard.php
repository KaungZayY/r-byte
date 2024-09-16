<?php

namespace App\Livewire;

use App\Models\Status;
use App\Models\Teammate;
use App\Models\Ticket;
use Livewire\Component;
use Laravel\Jetstream\InteractsWithBanner;

class TicketBoard extends Component
{
    use InteractsWithBanner;

    public $project;
    public $sprint;
    public $pinnedStatuses = [];
    public $editStatusId = null;
    public $editValues = [];

    public function render()
    {
        $sprint = $this->sprint;
        $project = $this->project;
        $statuses = $project->statuses()->orderBy('position')->get();
        foreach ($statuses as $status) 
        {
            $this->editValues[$status->id] = $status->status;
        }
        $tickets = $sprint->tickets()->with('teammates.user')->orderBy('position')->get();
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

    public function togglePinStatus($statusId)
    {
        if (in_array($statusId, $this->pinnedStatuses)) {
            $this->pinnedStatuses = array_values(array_diff($this->pinnedStatuses, [$statusId]));
        } 
        else {
            $this->pinnedStatuses[] = $statusId;
        }
    }

    public function destroy(Status $status)
    {
        if ($status->exists && !$status->tickets()->exists()) {
            $status->delete();
            $this->banner('Column Removed.');
        }
        else{
            $this->dangerBanner('Remove all tickets from this column across all sprints first.');
        }
    }

    public function edit(Status $status)
    {
        $this->editStatusId = $status->id;
    }

    public function update(Status $status)
    {
        $this->editStatusId = null;
        $this->validate([
            'editValues.' . $status->id => 'required|string|max:255',
        ]);
        try {
            $status->update([
                'status' => $this->editValues[$status->id],
            ]);
            $this->banner('Column Updated.');
        } catch (\Throwable $th) {
            $this->dangerBanner('Action Failed.');
        }
        
    }

    public function removeAssignee(Ticket $ticket, Teammate $teammate)
    {
        $ticket->teammates()->detach($teammate);
    }
}
