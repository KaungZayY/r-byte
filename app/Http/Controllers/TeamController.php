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
}
