<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_id',
        'status',
        'position',
        'description'
    ];

    public static function maxPosition($projectId): int
    {
        return self::where('project_id', $projectId)->max('position');
    }
}
