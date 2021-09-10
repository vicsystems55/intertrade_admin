<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruckRoute extends Model
{
    use HasFactory;

    public function deployments()
    {
        
        
        return $this->belongsTo('App\Models\TruckRoute', 'deployment_id', 'id');
    }

    public function trucks()
    {
        
        
        return $this->belongsTo('App\Models\Inventory', 'inventory_id', 'id');
    }

    public function drivers()
    {
        
        
        return $this->belongsTo('App\Models\User', 'driver_assigned', 'id');
    }
}
