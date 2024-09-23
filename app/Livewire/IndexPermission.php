<?php

namespace App\Livewire;

use App\Models\Feature;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class IndexPermission extends Component
{
    public $role;
    public $project;
    public $assignedPermissions = [];

    public function render()
    {
        $role = $this->role;
        $project = $this->project;
        $features = Feature::with('permissions')->get();
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        $this->assignedPermissions = $rolePermissions;
        return view('livewire.index-permission',compact('features','project','role','rolePermissions'));
    }

    public function toggleCheckbox($permissionId): void
    {
        $role = $this->role;
        Cache::forget("role_{$role->id}_permissions");
        $assignedPermissions = $this->assignedPermissions;

        if(in_array($permissionId,$assignedPermissions))
        {
            $role->permissions()->detach($permissionId);
        }
        else
        {
            $role->permissions()->attach($permissionId);
        }
    }

}
