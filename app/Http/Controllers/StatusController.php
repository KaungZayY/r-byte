<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusRequest;
use App\Models\Project;
use App\Models\Sprint;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function create(Project $project, Sprint $sprint)
    {
        return view('statuses.create-status',compact('project','sprint'));
    }

    public function store(StatusRequest $request, Project $project, Sprint $sprint)
    {
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
            return redirect()->route('tickets',['project'=>$project, 'sprint'=>$sprint])->dangerBanner('An Error Occured');
        }
    }
}
