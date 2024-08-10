<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teammate extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'user_id',
        'role_id',
        'invited_by'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class,'team_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class,'role_id','id');
    }
}
