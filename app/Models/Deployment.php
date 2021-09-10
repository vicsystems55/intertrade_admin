<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deployment extends Model
{
    use HasFactory;

    public function vehicles()
    {
        # code...


        return $this->belongsTo('App\Models\Inventory', 'inventory_id', 'id');
    }
}
