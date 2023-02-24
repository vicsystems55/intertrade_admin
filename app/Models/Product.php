<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function stock()
    {
        
        return $this->hasMany(Stock::class);
    }

    public function stock_sum()
    {
        
        return $this->hasMany(Stock::class)->sum('quantity');
    }

}
