<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamRequest;
use App\Models\Project;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index(Project $project)
    {
        $teams = $project->teams;
        $teams->load('user');
        $count = $teams->count();
        return view('teams.index-team',compact('teams','project','count'));
    }

    public function create(Project $project)
    {
        return view('teams.create-team',compact('project'));
    }

    public function store(Project $project, TeamRequest $request)
    {
        $validated = $request->validated();
        try {
            Team::create([
                'project_id' => $project->id,
                'team_name' => $validated['team_name'],
                'description' => $validated['description'],
                'created_by' => auth()->id(),
            ]);
            
            return redirect()->route('teams',$project)->banner('New Team Created.');

        } 
        catch (\Exception $e) 
        {
            return redirect()->route('teams',$project)->dangerBanner('An Error Occured');
        }
    }

    public function edit(Project $project, Team $team)
    {
        return view('teams.edit-team',compact('team','project'));
    }

    public function update(Project $project, Team $team, TeamRequest $request)
    {
        try{
            $team->update($request->validated());
            return redirect()->route('teams',$project)->banner('Team Updated.');
        }
        catch(\Exception $e){
            return redirect()->route('teams',$project)->dangerBanner('Cannot Update the Team');
        }
    }

    public function destroy(Project $project, Team $team)
    {
        if ($team->teammates()->exists()) {
            return redirect()->route('teams',$project)->dangerBanner('Remove the teammates first!');
        }

        try {
            $deleted = $team->delete();

            if (!$deleted) {
                return redirect()->route('teams',$project)->dangerBanner('Cannot remove this team.');
            }

            return redirect()->route('teams',$project)->banner('Team archived successfully.');
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('teams',$project)->dangerBanner('Cannot remove this team.');
        }
    }

    public function archives(Project $project)
    {
        $teams = $project->teams()->onlyTrashed()->with('user')->get();
        $count = $project->teams()->onlyTrashed()->count();
        return view('teams.archives-team',compact('teams','project','count'));
    }

    public function forceRemove($id)
    {
        $team = Team::withTrashed()->findOrFail($id);
        $project = $team->project;
        $team->forceDelete();
        return redirect()->route('teams.archives', $project)->banner('Team Deleted.');
    }

    public function restore($id)
    {
        $team = Team::withTrashed()->findOrFail($id);
        $team->restore();
        return redirect()->route('teams', $team->project)->banner('Team Restored.');
    }
}
