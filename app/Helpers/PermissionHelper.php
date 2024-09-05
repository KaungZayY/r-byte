<?php
namespace App\Helpers;

use App\Models\Feature;
use App\Models\Project;
use App\Models\Role;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PermissionHelper{
    
    public function isProjectOwner(Project $project): bool
    {
        $user = Auth::user();
        return $user->id === $project->created_by;
    }

    public function getPermissionId($featureName,$permissionName): int
    {
        $feature = Feature::where('feature_name',$featureName)->first();
        if($feature){
            $permission = $feature->permissions->where('permission_name',$permissionName)->first();
            if($permission){
                return $permission->id;
            }
        }
        return 0;
    }

    public function checkPermission(Project $project, $permissionId): bool
    {
        $user = Auth::user();
        $role_id = $user->roleForProject($project)->id;
        if($role_id)
        {
            $role = Role::where('id',$role_id)->first();
            return $role->permissions->contains('id', $permissionId);
        }
        return false;
    }

    public function authorizeUser(Project $project, $featureName, $permissionName): bool
    {
        if($this->isProjectOwner($project))
        {
            return true;
        }
        else
        {
            $permissionId = $this->getPermissionId($featureName,$permissionName);
            if ($permissionId === 0) {
                abort(Response::HTTP_FORBIDDEN, 'Unauthorized Access.');
            }
            $isAuthorized = $this->checkPermission($project, $permissionId);
            if (!$isAuthorized) {
                abort(Response::HTTP_FORBIDDEN, 'Unauthorized Access.');
            }
            return true;
        }
    }
}