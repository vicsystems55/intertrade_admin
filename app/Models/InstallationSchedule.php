<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstallationSchedule extends Model
{
    use HasFactory;

    
    protected $guarded = [];

    public function deployments()
    {
        
        
        return $this->belongsTo('App\Models\Deployment', 'deployment_id', 'id');
    }

    public function trucks()
    {
        
        
        return $this->belongsTo('App\Models\Inventory', 'inventory_id', 'id');
    }

    public function technicians()
    {
        
        
        return $this->belongsTo('App\Models\User', 'technician_assigned', 'id');
    }
}
