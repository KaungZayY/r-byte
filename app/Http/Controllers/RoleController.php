<?php

namespace App\Http\Controllers;

use App\Helpers\PermissionHelper;
use App\Http\Requests\RoleRequest;
use App\Models\Project;
use App\Models\Role;

class RoleController extends Controller
{
    protected $pHelper;

    public function __construct()
    {
        $this->pHelper = new PermissionHelper();
    }

    public function index(Project $project)
    {
        $this->pHelper->authorizeUser($project,'Roles','View');
        $roles = $project->roles;
        $count = $project->roles->count();
        return view('roles.index-role',compact('project','roles', 'count'));
    }

    public function create(Project $project)
    {
        $this->pHelper->authorizeUser($project,'Roles','Create');
        return view('roles.create-role',compact('project'));
    }

    public function store(Project $project, RoleRequest $request)
    {
        $this->pHelper->authorizeUser($project,'Roles','Create');
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

    public function edit(Project $project, Role $role)
    {
        $this->pHelper->authorizeUser($project,'Roles','Update');
        return view('roles.edit-role',compact('project','role'));
    }

    public function update(Project $project, Role $role, RoleRequest $request)
    {
        $this->pHelper->authorizeUser($project,'Roles','Update');
        try {
            $role->update($request->validated());
            return redirect()->route('roles',$project)->banner('Role Updated.');
        }
        catch (\Exception $e)
        {
            return redirect()->route('roles',$project)->dangerBanner('Cannot Update the Role');
        }
    }

    public function destroy(Project $project, Role $role)
    {
        $this->pHelper->authorizeUser($project,'Roles','Delete');
        if ($role->isAssignedToAnyUser($project)) 
        {
            return redirect()->route('roles', $project)->dangerBanner('Cannot delete the role because it is assigned to one or more users.');
        }

        try{
            $role->delete();
            return redirect()->route('roles',$project)->banner('Role Moved to Archives.');
        }
        catch (\Exception $e){
            return redirect()->route('roles',$project)->dangerBanner('Cannot Delete the Role');
        }
    }

    public function archives(Project $project)
    {
        $this->pHelper->authorizeUser($project,'Roles','Archives');
        $roles = $project->roles()->onlyTrashed()->get();
        $count = $project->roles()->onlyTrashed()->count();
        return view('roles.archives-role',compact('roles','project','count'));
    }

    public function restore(Project $project, $id)
    {
        $this->pHelper->authorizeUser($project,'Roles','Restore');
        $role = Role::withTrashed()->findOrFail($id);
        $role->restore();
        return redirect()->route('roles',$project)->banner('Role Restored.');
    }

    public function forceRemove(Project $project, $id)
    {
        $this->pHelper->authorizeUser($project,'Roles','ForceDelete');
        $role = Role::withTrashed()->findOrFail($id);
        $role->forceDelete();
        return redirect()->route('roles.archives',$project)->banner('Role Deleted Permanently.');
    }
}
