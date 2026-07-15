<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'vat_included' => 'boolean',
        'discount_percent' => 'decimal:3',
        'discount_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    public function invoice_line()
    {

        return $this->hasMany(InvoiceLine::class);
    }

    public function customer()
    {

        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
