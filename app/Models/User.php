<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function truck_routes()
    {
        # code...

        return $this->hasMany('App\Models\TruckRoute', 'driver_assigned', 'id');
    }

    public function deployment_reports()
    {

        return $this->hasMany('App\Models\DeploymentReport', 'reporter_id', 'id');
    }

    public function salary_level()
    {

        return $this->belongsTo(SalaryStructure::class, 'salary_structure_id', 'id');
    }

    public function employee_data()
    {

        return $this->hasOne(EmployeeBioData::class, 'user_id', 'id');
    }
}
