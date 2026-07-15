<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceLine extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'quantity' => 'decimal:3',
        'amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'discount_percent' => 'decimal:3',
        'discount_amount' => 'decimal:2',
    ];

    public function product()
    {

        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function invoice(){


        return $this->belongsTo(Invoice::class, 'invoice_id', 'id');

    }

}

