<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Project;
use App\Models\Role;
use App\Models\Team;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index(Project $project)
    {
        return view('roles.index-role',compact('project'));
    }

    public function create(Project $project)
    {
        return view('roles.create-role',compact('project'));
    }

    public function store(Project $project, RoleRequest $request)
    {
        $validated = $request->validated();
        try {
            Role::create([
                'project_id' => $project->id,
                'role_name' => $validated['role_name'],
                'description' => $validated['description']
            ]);
            
            return redirect()->route('roles',$project)->banner('New Role Created!');

        } 
        catch (\Exception $e) 
        {
            // dd($e);
            return redirect()->route('roles')->dangerBanner('An Error Occured');
        }
    }
}
