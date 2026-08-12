<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = [];

    public function payer()
    {
        return $this->belongsTo(Payer::class);
    }

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }
}