<?php

namespace App\Http\Controllers;

use App\Http\Requests\SprintRequest;
use App\Models\Project;
use App\Models\Sprint;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SprintController extends Controller
{
    public function index(Project $project)
    {
        $sprints = $project->sprints;
        $count = $sprints->count();
        return view('sprints.index-sprint',compact('project','sprints','count'));
    }

    public function create(Project $project)
    {
        return view('sprints.create-sprint',compact('project'));
    }

    public function store(SprintRequest $request, Project $project)
    {
        $validated = $request->validated();
        try {
            $sprintStartDate = Carbon::parse($validated['sprint_start_date']);
            $sprintEndDate = Carbon::parse($validated['sprint_end_date']);
            Sprint::create([
                'project_id' => $project->id,
                'sprint_name' => $validated['sprint_name'],
                'status' => 'inactive',
                'description' => $validated['description'],
                'sprint_start_date' => $validated['sprint_start_date'],
                'duration' => $sprintStartDate->diffInDays($sprintEndDate),
                'sprint_end_date' => $validated['sprint_end_date'],
            ]);
            
            return redirect()->route('sprints',$project)->banner('New Sprint created successfully.');

        } 
        catch (\Exception $e) 
        {
            return redirect()->route('sprints',$project)->dangerBanner('An Error Occured');
        }
    }
}
