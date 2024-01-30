<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePaycheckItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function paycheckItem(){

        return $this->belongsTo(PaycheckItem::class, 'paycheck_item_id', 'id');
    }
}
