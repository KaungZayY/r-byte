<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'backlog_id',
        'project_id',
        'sprint_id',
        'ticket_name',
        'status_id',
        'position',
        'duration',
        'description',
        'backlog_created_by',
        'ticket_created_by'
    ];

    public function teammates()
    {
        return $this->belongsToMany(Teammate::class,'teammate_ticket');
    }

    public function backlog()
    {
        return $this->belongsTo(Backlog::class,'backlog_id','id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class,'status_id','id');
    }

    public function sprint()
    {
        return $this->belongsTo(Sprint::class,'sprint_id','id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id','id');
    }

    public function backlog_created_by_user()
    {
        return $this->belongsTo(User::class,'backlog_created_by','id');
    }

    public function ticket_created_by_user()
    {
        return $this->belongsTo(User::class,'ticket_created_by','id');
    }

    public function ticket_trackers()
    {
        return $this->hasMany(TicketTracker::class,'ticket_id','id');
    }

    public function total_time_taken()
    {
        $total_time = 0;
        foreach ($this->ticket_trackers  as $ticket_tracker){
            $total_time += $ticket_tracker->time_taken;
        }
        return $total_time;
    }
}
