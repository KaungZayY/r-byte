<?php

namespace App\Http\Controllers;

use App\Helpers\PermissionHelper;
use App\Http\Requests\ProjectDeleteRequest;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Database\Seeders\StatusSeeder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    protected $pHelper;

    public function __construct()
    {
        $this->pHelper = new PermissionHelper();
    }

    public function create()
    {
        return view('projects.create-project');
    }

    public function store(ProjectRequest $request)
    {
        $validated = $request->validated();
        try {
            $project = Project::create([
                'project_name' => $validated['project_name'],
                'description' => $validated['description'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'created_by' => auth()->id(),
            ]);
            $seeder = new StatusSeeder();
            $seeder->run($project);
            return redirect()->route('dashboard')->banner('New project created successfully.');

        } 
        catch (\Exception $e) 
        {
            // dd($e);
            Log::error($e->getMessage());
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
            if(!$this->pHelper->isProjectOwner($project)){
                throw new Exception('User Id '.Auth::user()->id.' was trying to update the non owner Project Id '.$project->id);
            }
            $project->update($request->validated());
            return redirect()->route('dashboard')->banner('Project Detail Updated.');
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()->route('dashboard')->dangerBanner('Cannot Update the Project Detail');
        }
    }

    public function delete(Project $project)
    {
        return view('projects.delete-project',compact('project'));
    }

    public function destroy(ProjectDeleteRequest $request, Project $project)
    {
        $validated = $request->validated();
        $project_name = $validated['project_name'];
        if($project_name != $project->project_name){
            return redirect()->route('projects.delete',$project)->withErrors([
                'project_name' => 'The project name does not match.'
            ]);
        }
        
        try {
            $project->delete();
            return redirect()->route('dashboard')->banner('Project Deleted');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('dashboard')->dangerBanner('Cannot Delete the Project');
        }
    }

    public function detail(Project $project)
    {
        $sprint = $project->sprints()->where('status','active')->first();
        return view('projects.details-project',compact('project','sprint'));
    }
}
