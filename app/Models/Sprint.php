<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sprint extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_id',
        'sprint_name',
        'status',
        'sprint_start_date',
        'sprint_end_date',
        'duration',
        'description'
    ];

    protected $casts = [
        'sprint_start_date' => 'datetime',
        'sprint_end_date' => 'datetime',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function completeActiveSprintForProject($projectId)
    {
        self::where('project_id', $projectId)->where('status', 'active')->update(['status' => 'completed']);
    }

    public function getMaxPositionForTicket($statusId): int
    {
        return Ticket::where('status_id', $statusId)->max('position') ?? 0;
    }
}
