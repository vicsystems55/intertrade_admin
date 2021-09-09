<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountHead extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function mappings()
    {
        
        return $this->hasMany('App\Models\AccountMapping', 'account_heads_id');
    }
}
