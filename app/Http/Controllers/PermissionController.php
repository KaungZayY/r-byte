<?php

namespace App\Http\Controllers;

use App\Helpers\PermissionHelper;
use App\Models\Project;
use App\Models\Role;

class PermissionController extends Controller
{
    protected $pHelper;

    public function __construct()
    {
        $this->pHelper = new PermissionHelper();
    }

    public function index(Project $project, Role $role)
    {
        $this->pHelper->authorizeUser($project,'Roles','GrantPermission');
        return view('permissions.index-permission',compact('project','role'));
    }
}
