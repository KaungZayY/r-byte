<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name',
        'start_date',
        'end_date',
        'description',
        'created_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }
    public function teams()
    {
        return $this->hasMany(Team::class,'project_id','id');
    }

    public function backlogs()
    {
        return $this->hasMany(Backlog::class,'project_id','id');
    }

    public function sprints()
    {
        return $this->hasMany(Sprint::class, 'project_id', 'id');
    }

    public function roles()
    {
        return $this->hasMany(Role::class, 'project_id', 'id');
    }

    public function statuses()
    {
        return $this->hasMany(Status::class,'project_id','id');
    }

    public function getToDoStatusId(Project $project): int
    {
        return $project->statuses->where('status','To Do')->value('id');
    }
}
