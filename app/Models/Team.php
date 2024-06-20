<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use HasFactory,SoftDeletes;

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id','id');
    }

    public function teammates()
    {
        return $this->hasMany(Teammate::class,'team_id','id');
    }
}
