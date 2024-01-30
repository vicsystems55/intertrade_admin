<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanSchedule extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function loanApplication(){

        return $this->belongsTo(LoanApplication::class);
    }
}
