<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientProject extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function milestones()
    {
            
        return $this->hasMany(ProjectMilestone::class);
    }
}
