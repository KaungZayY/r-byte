<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketTracker extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'prev_status_id',
        'new_status_id',
        'time_taken',
        'updated_by',
    ];
}
