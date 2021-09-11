<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeploymentReport extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function report_images()
    {
        
        
        return $this->hasMany('App\Models\ReportImage', 'report_id', 'id');
    }
}
