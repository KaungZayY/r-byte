<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'status',
        'status_type',
        'position',
        'description'
    ];

    public static function maxPosition($projectId): int
    {
        return self::where('project_id', $projectId)->max('position');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class,'status_id','id');
    }
}
