<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoadAuditGeneration extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function loadEntries(){
        return $this->hasMany(LoadEntry::class);
    }
}
