<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'feature_name',
    ];

    public function permissions(){
        return $this->hasMany(Permission::class, 'feature_id','id');
    }
}
