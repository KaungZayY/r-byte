<?php

namespace App\Http\Controllers;

use App\Http\Requests\BacklogRequest;
use App\Models\Backlog;
use App\Models\Project;
use Illuminate\Http\Request;

class BacklogController extends Controller
{

    public function index(Project $project)
    {
        $backlogs = $project->backlogs()->with('user')->get();
        $backlogsCount = $project->backlogs()->count();
        return view('backlogs.index-backlog',compact('backlogs','project','backlogsCount'));
    }

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
                'status' => 'pending',
                'description' => $validated['description'],
                'created_by' => auth()->id(),
            ]);
            
            return redirect()->route('backlogs',$project)->banner('New backlog added.');

        } 
        catch (\Exception $e) 
        {
            return redirect()->route('backlogs',$project)->dangerBanner('An Error Occured');
        }
    }

    public function edit(Project $project, Backlog $backlog)
    {
        return view('backlogs.edit-backlog',compact('backlog','project'));
    }

    public function update(Project $project, BacklogRequest $request, Backlog $backlog)
    {
        try{
            $backlog->update($request->validated());
            return redirect()->route('backlogs',$project)->banner('Backlog Updated.');
        }
        catch(\Exception $e){
            return redirect()->route('backlogs',$project)->dangerBanner('Cannot Update the Backlog');
        }
    }

    public function destroy(Project $project, Backlog $backlog)
    {
        try 
        {
            if ($backlog->exists && $backlog->status === 'pending') 
            {
                $backlog->delete();
                return redirect()->route('backlogs', $project)->banner('Backlog archived.');
            }
            
            return redirect()->route('backlogs', $project)->dangerBanner('An error occurred while archiving the backlog.');
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('backlogs',$project)->dangerBanner('An Error Occured');
        }
    }

    public function archives(Project $project)
    {
        $backlogs = $project->backlogs()->onlyTrashed()->with('user')->get();
        $backlogsCount = $project->backlogs()->onlyTrashed()->count();
        return view('backlogs.archives-backlog',compact('backlogs','project','backlogsCount'));
    }

    public function forceRemove($id)
    {
        $backlog = Backlog::withTrashed()->findOrFail($id);
        $project = $backlog->project;
        $backlog->forceDelete();
        return redirect()->route('backlogs.archives', $project)->banner('Backlog Deleted.');
    }

    public function restore($id)
    {
        $backlog = Backlog::withTrashed()->findOrFail($id);
        $backlog->restore();
        return redirect()->route('backlogs', $backlog->project)->banner('Backlog Restored.');
    }
}
