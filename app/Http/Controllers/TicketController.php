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

    public function detail(Ticket $ticket)
    {
        $ticket->load('project','sprint','backlog','status','backlog_created_by_user','ticket_created_by_user');
        return view('tickets.detail-ticket',compact('ticket'));
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
        $sprint_id = intval($validated['sprint_id']);
        $sprint = Sprint::findOrFail($sprint_id);
        $statusId = $project->getToDoStatusId($project);
        $position = $sprint->getMaxPositionForTicket($statusId)+1;
        $duration = $validated['duration_in_hour'] * 60 + $validated['duration_in_minutes'];
        try {
            Ticket::create([
                'sprint_id' => $sprint->id,
                'backlog_id' => $backlog->id,
                'project_id' => $backlog->project_id,
                'ticket_name' => $validated['ticket_name'],
                'status_id' => $statusId,
                'position' => $position,
                'duration' => $duration,
                'description' => $validated['description'],
                'backlog_created_by' => $backlog->created_by,
                'ticket_created_by' => auth()->id(),
            ]);

            $backlog->update(['status' => 'assigned']);
            return redirect()->route('backlogs',$project)->banner('Ticket created.');  
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('backlogs',$project)->dangerBanner('An Error Occured');
        }
    }

    public function directCreate(Project $project, Sprint $sprint)
    {
        $this->pHelper->authorizeUser($project,'Backlogs','CreateTicket');
        $sprints = $project->sprints;
        return view('tickets.direct-create-ticket',compact('project','sprint','sprints'));
    }

    public function directStore(Project $project, Sprint $sprint, TicketRequest $request)
    {
        $this->pHelper->authorizeUser($project,'Backlogs','CreateTicket');
        $validated = $request->validated();
        $sprint_id = intval($validated['sprint_id']);
        $statusId = $project->getToDoStatusId($project);
        $position = $sprint->getMaxPositionForTicket($statusId)+1;
        $duration = $validated['duration_in_hour'] * 60 + $validated['duration_in_minutes'];
        try 
        {
            Ticket::create([
                'sprint_id' => $sprint_id,
                'project_id' => $project->id,
                'ticket_name' => $validated['ticket_name'],
                'status_id' => $statusId,
                'position' => $position,
                'duration' => $duration,
                'description' => $validated['description'],
                'ticket_created_by' => auth()->id(),
            ]);
            return redirect()->route('tickets',['project'=>$project,'sprint'=>$sprint])->banner('Ticket created.');

        } catch (\Exception $e) 
        {
            return redirect()->route('backlogs',['project'=>$project,'sprint'=>$sprint])->dangerBanner('An Error Occured');
        }

    }

    public function addTeammate(Project $project, Ticket $ticket)
    {
        return view('tickets.assign-teammate',compact('project','ticket'));
    }
}
