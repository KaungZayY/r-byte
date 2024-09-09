<?php

namespace App\Http\Controllers;

use App\Helpers\PermissionHelper;
use App\Http\Requests\TicketRequest;
use App\Models\Backlog;
use App\Models\Project;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    protected $pHelper;

    public function __construct()
    {
        $this->pHelper = new PermissionHelper();
    }

    public function create(Project $project, Backlog $backlog)
    {
        $this->pHelper->authorizeUser($project,'Backlogs','CreateTicket');
        $sprints = $project->sprints->all();
        return view('tickets.create-ticket',compact('project','backlog','sprints'));
    }

    public function store(TicketRequest $request, Project $project, Backlog $backlog)
    {
        $this->pHelper->authorizeUser($project,'Backlogs','CreateTicket');
        $validated = $request->validated();
        try {
            $ticket = Ticket::create([
                'backlog_id' => $backlog->id,
                'project_id' => $backlog->project_id,
                'ticket_name' => $validated['ticket_name'],
                'duration' => $validated['duration'],
                'description' => $validated['description'],
                'backlog_created_by' => $backlog->created_by,
                'ticket_created_by' => auth()->id(),
            ]);
            $sprintId = intval($validated['sprint_id']);
            $sprintTicket = $ticket->insertSprintTicket($project->id, $sprintId, $ticket->id);
            if(!$sprintTicket){
                $ticket->forceDelete();
                return redirect()->route('backlogs',$project)->dangerBanner('An Unexpected Error Occured');
            }
            $backlog->update(['status' => 'assigned']);
            return redirect()->route('backlogs',$project)->banner('Ticket created.');
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('backlogs',$project)->dangerBanner('An Error Occured');
        }
    }
}
