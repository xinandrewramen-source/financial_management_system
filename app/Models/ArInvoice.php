<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'invoice_number',
        'source_type',
        'gross_amount',
        'vat_amount',
        'total_amount_due',
        'amount_collected',
        'due_date',
        'status',
        'metadata'
    ];

    protected $casts = [
        'metadata' => 'array', // PostgreSQL JSONB cast to PHP Array automatically
        'due_date' => 'date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }
}