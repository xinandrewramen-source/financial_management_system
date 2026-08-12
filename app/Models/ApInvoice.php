<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApInvoice extends Model
{
    protected $fillable = [
        'supplier_id',
        'invoice_number',
        'total_amount',
        'paid_amount',
        'balance',
        'status',
        'issue_date',
        'due_date',
        'description',
        'metadata',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'balance' => 'decimal:2',
        'issue_date' => 'date',
        'due_date' => 'date',
        'metadata' => 'array',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function payments()
    {
        return $this->hasMany(ApPayment::class);
    }
}
