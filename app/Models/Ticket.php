<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'backlog_id',
        'project_id',
        'ticket_name',
        'duration',
        'description',
        'backlog_created_by',
        'ticket_created_by'
    ];

    public function insertSprintTicket($projectId, $sprintId, $ticketId): bool
    {
        if (!is_int($projectId) || !is_int($sprintId) || !is_int($ticketId) || $projectId <= 0 || $sprintId <= 0 || $ticketId <= 0) {
            return false;
        }

        try {
            DB::beginTransaction();
            $statusId = DB::table('statuses')
                    ->where('project_id', $projectId)
                    ->where('status','To Do')
                    ->value('id');

            $maxPosition = DB::table('sprint_ticket')
                        ->where('sprint_id', $sprintId)
                        ->max('position') ?? 0;

            DB::table('sprint_ticket')->insert([
                'position' => $maxPosition + 1,
                'sprint_id' => $sprintId,
                'ticket_id' => $ticketId,
                'status_id' => $statusId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::commit();
            return true;
        } 
        catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
