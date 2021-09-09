<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountMapping extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function heads()
    {
        
        return $this->belongsTo('App\Models\AccountHead', 'account_heads_id', 'id');
    }

    public function subheads()
    {
        
        return $this->belongsTo('App\Models\AccountSubHead', 'account_sub_head_id', 'id');
    }
}
