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

}
