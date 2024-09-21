<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketTracker extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'ticket_id',
        'status_id',
        'started_at',
        'ended_at',
        'time_taken',
        'updated_by'
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class,'ticket_id','id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class,'status_id','id');
    }

    public function updated_by_user()
    {
        return $this->belongsTo(User::class,'updated_by','id');
    }
}
