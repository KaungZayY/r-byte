<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Team extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'project_id',
        'team_name',
        'description',
        'created_by'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id','id');
    }

    public function teammates()
    {
        return $this->hasMany(Teammate::class,'team_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }

    public function teammatesWithRoles(Project $project)
    {
        $teammates = $this->teammates()->with('user')->get();
        $userIds = $teammates->pluck('user.id')->unique();
        $roles = DB::table('user_project_role')
            ->whereIn('user_id', $userIds)
            ->where('user_project_role.project_id', $project->id)
            ->join('roles', 'roles.id', '=', 'user_project_role.role_id')
            ->select('user_id', 'roles.*')
            ->get()
            ->keyBy('user_id');
        
        return [$teammates, $roles];
    }
}
