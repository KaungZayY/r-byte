<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'project_id',
        'role_name',
        'description'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id','id');
    }

    public function isAssignedToAnyUser(Project $project)
    {
        return DB::table('user_project_role')
            ->where('project_id', $project->id)
            ->where('role_id', $this->id)
            ->exists();
    }
}
