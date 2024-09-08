<?php

namespace App\Http\Controllers;

use App\Helpers\PermissionHelper;
use App\Models\Project;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class UserRoleController extends Controller
{
    protected $pHelper;

    public function __construct()
    {
        $this->pHelper = new PermissionHelper();
    }

    public function addRole(Project $project, Team $team, User $user)
    {
        $this->pHelper->authorizeUser($project,'Teammates','AssignRole');
        $roles = Role::where('project_id',$project->id)->get();
        return view('roles.assign-role',compact('project','roles','user','team'));
    }

    public function assignRole(Request $request,Project $project, Team $team,User $user)
    {
        $this->pHelper->authorizeUser($project,'Teammates','AssignRole');
        $request->validate(['role_id'=>'required|exists:roles,id']);
        try {
            DB::table('user_project_role')->insert([
                'user_id'    => $user->id,
                'project_id' => $project->id,
                'role_id'    => $request->role_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect()->route('teammates',[$project,$team])->banner('Role has been successfully assigned.');
        } 
        catch (\Exception $e) {
            return redirect()->route('teammates',[$project,$team])->dangerBanner('Cannot assign role to this user');
        }
    }

    public function updateRole(Project $project, Team $team, User $user)
    {
        $this->pHelper->authorizeUser($project,'Teammates','ReassignRole');
        $roles = Role::where('project_id',$project->id)->get();
        $assignedRole = $user->roleForProject($project);
        return view('roles.edit-assign-role',compact('project','roles','user','team','assignedRole'));
    }

    public function reassignRole(Request $request,Project $project, Team $team,User $user)
    {
        $this->pHelper->authorizeUser($project,'Teammates','ReassignRole');
        $request->validate(['role_id'=>'required|exists:roles,id']);
        try {
            DB::table('user_project_role')
            ->where('user_id', $user->id)
            ->where('project_id', $project->id)
            ->update([
                'role_id'    => $request->role_id,
                'updated_at' => now(),
            ]);
            Cache::forget("user_{$user->id}_project_{$project->id}_role_is");
            return redirect()->route('teammates',[$project,$team])->banner('Role has been successfully updated.');
        } 
        catch (\Exception $e) {
            return redirect()->route('teammates',[$project,$team])->dangerBanner('Cannot update role to this user');
        }
    }
}
