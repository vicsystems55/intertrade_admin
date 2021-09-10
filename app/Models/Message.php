<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tos()
    {
        

        return $this->belongsTo('App\Models\User', 't_o', 'id');
    }

    public function fr_oms()
    {
        

        return $this->belongsTo('App\Models\User', 'fr_om', 'id');
    }
}
