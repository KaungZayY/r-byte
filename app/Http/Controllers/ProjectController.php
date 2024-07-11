<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function create()
    {
        return view('projects.create-project');
    }

    public function store(ProjectRequest $request)
    {
        $validated = $request->validated();
        try {
            Project::create([
                'project_name' => $validated['project_name'],
                'description' => $validated['description'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'created_by' => auth()->id(),
            ]);
            
            return redirect()->route('dashboard')->banner('New project created successfully.');

        } 
        catch (\Exception $e) 
        {
            return redirect()->route('dashboard')->dangerBanner('An Error Occured');
        }
    }

    public function edit(Project $project)
    {
        return view('projects.edit-project',compact('project'));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        try{
            $project->update($request->validated());
            return redirect()->route('dashboard')->banner('Project Detail Updated.');
        }
        catch(\Exception $e){
            return redirect()->route('dashboard')->dangerBanner('Cannot Update the Project Detail');
        }
    }
}
