<?php
namespace App\Helpers;

use App\Models\Feature;
use App\Models\Project;
use App\Models\Role;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PermissionHelper{
    
    public function isProjectOwner(Project $project): bool
    {
        $user = Auth::user();
        $cacheKey = "is_user_{$user->id}_owner_of_{$project->id}";
        return Cache::remember($cacheKey,now()->addMinutes(15), function () use ($user, $project){
            return $user->id === $project->created_by;
        });
    }

    public function getPermissionId($featureName,$permissionName): int
    {
        $cacheKey = "permission_id_of_{$featureName}_{$permissionName}_is";
        return Cache::rememberForever($cacheKey, function() use ($featureName, $permissionName){
            $feature = Feature::where('feature_name',$featureName)->first();
            if($feature){
                $permission = $feature->permissions->where('permission_name',$permissionName)->first();
                if($permission){
                    return $permission->id;
                }
            }
            return 0;
        });
    }

    public function checkPermission(Project $project, $permissionId): bool
    {
        $user = Auth::user();
        $role_id = Cache::remember("user_{$user->id}_project_{$project->id}_role_is", now()->addMinutes(30), function () use ($user, $project) {
            $user_role = $user->roleForProject($project)?->id;
            if(isset($user_role)){
                return $user_role;
            }
            else{
                return 0;
            }
        });
        if ($role_id) {
                $permissions = Cache::remember("role_{$role_id}_permissions", now()->addMinutes(30), function () use ($role_id) {
                $role = Role::with('permissions')->find($role_id);
                return $role ? $role->permissions->pluck('id')->toArray() : [];
            });
    
            return in_array($permissionId, $permissions);
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