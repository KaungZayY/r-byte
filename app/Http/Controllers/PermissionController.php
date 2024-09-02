<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Role;

class PermissionController extends Controller
{
    public function index(Project $project, Role $role)
    {
        return view('permissions.index-permission',compact('project','role'));
    }
}
