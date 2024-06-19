<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_name',
        'start_date',
        'end_date',
        'description',
        'created_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
