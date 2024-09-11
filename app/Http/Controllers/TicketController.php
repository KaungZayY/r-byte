<?php

namespace App\Http\Controllers;

use App\Helpers\PermissionHelper;
use App\Http\Requests\TicketRequest;
use App\Models\Backlog;
use App\Models\Project;
use App\Models\Sprint;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    protected $pHelper;

    public function __construct()
    {
        $this->pHelper = new PermissionHelper();
    }

    public function index(Project $project, Sprint $sprint)
    {
        return view('tickets.index-ticket',compact('project','sprint'));
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
        $sprint = Sprint::findOrFail($validated['sprint_id'])->first();
        $statusId = $project->getToDoStatusId($project);
        $position = $sprint->getMaxPositionForTicket($statusId)+1;
        try {
            $ticket = Ticket::create([
                'sprint_id' => $sprint->id,
                'backlog_id' => $backlog->id,
                'project_id' => $backlog->project_id,
                'ticket_name' => $validated['ticket_name'],
                'status_id' => $statusId,
                'position' => $position,
                'duration' => $validated['duration'],
                'description' => $validated['description'],
                'backlog_created_by' => $backlog->created_by,
                'ticket_created_by' => auth()->id(),
            ]);
            if(!$ticket){
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
