<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashRequest extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function requestby()
    {
        
        
        return $this->belongsTo(User::class, 'request_by', 'id');
    }
}
