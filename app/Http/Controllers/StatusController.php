<?php

namespace App\Http\Controllers;

use App\Helpers\PermissionHelper;
use App\Http\Requests\StatusRequest;
use App\Models\Project;
use App\Models\Sprint;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StatusController extends Controller
{
    protected $pHelper;

    public function __construct()
    {
        $this->pHelper = new PermissionHelper();
    }

    public function create(Project $project, Sprint $sprint)
    {
        $this->pHelper->authorizeUser($project,'Statuses','Create');
        return view('statuses.create-status',compact('project','sprint'));
    }

    public function store(StatusRequest $request, Project $project, Sprint $sprint)
    {
        $this->pHelper->authorizeUser($project,'Statuses','Create');
        
        $validated = $request->validated();
        $position = Status::maxPosition($project->id) + 1;
        try {
            Status::create([
                'project_id' => $project->id,
                'status' => $validated['status'],
                'position' => $position,
                'description' => $validated['description']
            ]);
            
            return redirect()->route('tickets',['project'=>$project, 'sprint'=>$sprint])->banner('New Status Created!');

        } 
        catch (\Exception $e) 
        {
            // dd($e);
            Log::error($e->getMessage());
            return redirect()->route('tickets',['project'=>$project, 'sprint'=>$sprint])->dangerBanner('An Error Occured');
        }
    }
}
