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

            $conflictingSprints = Sprint::where('project_id', $project->id)
            ->where(function($query) use ($sprintStartDate, $sprintEndDate) {
                $query->where(function($subQuery) use ($sprintStartDate, $sprintEndDate) {
                    $subQuery->where('sprint_start_date', '<=', $sprintEndDate)
                             ->where('sprint_end_date', '>=', $sprintStartDate);
                });
            })
            ->exists();

            if ($conflictingSprints) {
                return redirect()->route('sprints', $project)
                    ->dangerBanner('A sprint with overlapping dates already exists. Please choose different dates.');
            }

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

    public function startSprint(Sprint $sprint)
    {
        $project = $sprint->project;
        Sprint::where('project_id', $project->id)->where('status', 'active')->update(['status' => 'completed']);
        $sprint->status = 'active';
        $sprint->save();
        return redirect()->route('sprints',$project)->banner('New Sprint has Successfully Started!.');
    }

    public function edit(Project $project, Sprint $sprint)
    {
        return view('sprints.edit-sprint',compact('project','sprint'));
    }

    public function update(SprintRequest $request, Project $project, Sprint $sprint)
    {
        $validated = $request->validated();
        try 
        {
            $sprintStartDate = Carbon::parse($validated['sprint_start_date']);
            $sprintEndDate = Carbon::parse($validated['sprint_end_date']);

            $conflictingSprints = Sprint::where('project_id', $project->id)
            ->where('id', '!=', $sprint->id)
            ->where(function($query) use ($sprintStartDate, $sprintEndDate) {
                $query->where(function($subQuery) use ($sprintStartDate, $sprintEndDate) {
                    $subQuery->where('sprint_start_date', '<=', $sprintEndDate)
                             ->where('sprint_end_date', '>=', $sprintStartDate);
                });
            })
            ->exists();

            if ($conflictingSprints) {
                return redirect()->route('sprints', $project)
                    ->dangerBanner('A sprint with overlapping dates already exists. Please choose different dates.');
            }

            $sprint->update([
                'sprint_name' => $validated['sprint_name'],
                'description' => $validated['description'],
                'sprint_start_date' => $validated['sprint_start_date'],
                'duration' => $sprintStartDate->diffInDays($sprintEndDate),
                'sprint_end_date' => $validated['sprint_end_date'],
            ]);
            return redirect()->route('sprints', $project)->banner('Sprint updated successfully.');
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('sprints.edit', [$project, $sprint])->dangerBanner('An Error Occurred');
        }
    }

    public function destroy(Sprint $sprint)
    {
        try 
        {
            if ($sprint->status === 'inactive') 
            {
                $sprint->delete();
                return redirect()->route('sprints', $sprint->project)->banner('Sprint archived.');
            }
            
            return redirect()->route('sprints', $sprint->project)->dangerBanner('An error occurred while archiving the Sprint.');
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('sprints',$sprint->project)->dangerBanner('An Error Occured');
        }
    }

    public function archives(Project $project)
    {
        $sprints = $project->sprints()->onlyTrashed()->get();
        $count = $project->sprints()->onlyTrashed()->count();
        return view('sprints.archives-sprint',compact('sprints','project','count'));
    }

    public function restore(Project $project, $id)
    {
        $sprint = Sprint::withTrashed()->findOrFail($id);
        $sprint->restore();
        return redirect()->route('sprints', $project)->banner('Sprint Restored.');
    }

    public function forceRemove($id)
    {
        $sprint = Sprint::withTrashed()->findOrFail($id);
        $project = $sprint->project;
        $sprint->forceDelete();
        return redirect()->route('sprints.archives', $project)->banner('Sprint Deleted.');
    }
}
