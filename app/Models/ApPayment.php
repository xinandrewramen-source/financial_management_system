<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApPayment extends Model
{
    protected $fillable = [
        'ap_invoice_id',
        'supplier_id',
        'amount_paid',
        'payment_method',
        'reference_number',
        'payment_date',
        'notes',
    ];

    protected $casts = [
        'amount_paid' => 'decimal:2',
        'payment_date' => 'date',
    ];

    public function apInvoice()
    {
        return $this->belongsTo(ApInvoice::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
