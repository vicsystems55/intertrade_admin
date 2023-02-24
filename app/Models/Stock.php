<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product()
    {
        
        
        return $this->belongsTo(Product::class);
    }

    public function invoice()
    {
        
        return $this->belongsTo(Invoice::class, 'invoice_id', 'id');
    }

    public function receiver()
    {
        
        return $this->belongsTo(User::class, 'received_by', 'id');
    }
}
