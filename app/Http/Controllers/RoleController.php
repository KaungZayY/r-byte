<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Project;
use App\Models\Role;

class RoleController extends Controller
{

    public function index(Project $project)
    {
        $roles = $project->roles;
        $count = $project->roles->count();
        return view('roles.index-role',compact('project','roles', 'count'));
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
