<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'permission_name',
    ];

    public function feature(){
        return $this->belongsTo(Feature::class, 'feature_id','id');
    }

    public function roles(){
        return $this->belongsToMany(Role::class, 'role_permission');
    }
}
