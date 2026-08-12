<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'contact_person',
        'email',
        'phone',
        'address',
        'payment_terms_days',
    ];

    public function apInvoices()
    {
        return $this->hasMany(ApInvoice::class);
    }

    public function apPayments()
    {
        return $this->hasMany(ApPayment::class);
    }
}