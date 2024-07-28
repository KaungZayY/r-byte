<?php

namespace App\Http\Controllers;

use App\Http\Requests\BacklogRequest;
use App\Models\Backlog;
use App\Models\Project;
use Illuminate\Http\Request;

class BacklogController extends Controller
{
    public function create(Project $project)
    {
        return view('backlogs.create-backlog',compact('project'));
    }

    public function store(BacklogRequest $request, Project $project)
    {
        $validated = $request->validated();
        try {
            Backlog::create([
                'project_id' => $project->id,
                'backlog' => $validated['backlog'],
                'description' => $validated['description'],
                'created_by' => auth()->id(),
            ]);
            
            return redirect()->route('projects.detail',$project)->banner('New backlog added.');

        } 
        catch (\Exception $e) 
        {
            return redirect()->route('projects.detail',$project)->dangerBanner('An Error Occured');
        }
    }
}
