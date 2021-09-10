<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    public function deployments()
    {
        
        
        return $this->hasMany('App\Models\Deployment', 'inventory_id', 'id');
    }
}
