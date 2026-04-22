<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstallationLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name',
        'location_name',
        'latitude',
        'longitude',
        'project_type',
        'description',
        'state',
        'local_government',
        'installation_date',
        'status'
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'installation_date' => 'date'
    ];
}
