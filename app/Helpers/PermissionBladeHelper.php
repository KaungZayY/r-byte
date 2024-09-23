<?php

use App\Helpers\PermissionHelper;
use App\Models\Project;

function viewContent(Project $project, $featureName, $permissionName): bool
{
    $pHelper = new PermissionHelper();
    if ($pHelper->isProjectOwner($project)) 
    {
        return true;
    } 
    else 
    {
        $permissionId = $pHelper->getPermissionId($featureName, $permissionName);
        if ($permissionId === 0) {
            return false;
        }
        $isAuthorized = $pHelper->checkPermission($project, $permissionId);
        if (!$isAuthorized) {
            return false;
        }
        return true;
    }
}
