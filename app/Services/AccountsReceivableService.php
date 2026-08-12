<?php

namespace App\Services;

use App\Models\ArInvoice;
use App\Models\Collection;
use Illuminate\Support\Facades\DB;
use Exception;

class AccountsReceivableService
{
    /**
     * Reconcile & Record a Received Payment (Collection)
     */
    public function recordCollection(array $data): Collection
    {
        // Gagamit tayo ng PostgreSQL Transaction para LIGTAS at walang data loss
        return DB::transaction(function () use ($data) {
            
            // 1. Hanapin ang kinauukulang AR Invoice (Lock row for update)
            $invoice = ArInvoice::where('id', $data['ar_invoice_id'])
                ->lockForUpdate()
                ->firstOrFail();

            // 2. I-save ang Collection record
            $collection = Collection::create([
                'ar_invoice_id'        => $invoice->id,
                'or_number'            => 'OR-' . strtoupper(uniqid()),
                'amount_received'      => $data['amount_received'],
                'payment_method'       => $data['payment_method'],
                'gateway_reference_no' => $data['gateway_reference_no'] ?? null,
                'collected_at'         => now(),
                'status'               => $data['status'] ?? 'VERIFIED',
            ]);

            // 3. I-update ang running total of payments sa AR Invoice
            $newAmountCollected = $invoice->amount_collected + $data['amount_received'];
            $invoice->amount_collected = $newAmountCollected;

            // 4. Auto-update ng Status (UNPAID -> PARTIALLY_PAID -> PAID)
            if ($newAmountCollected >= $invoice->total_amount_due) {
                $invoice->status = 'PAID';
            } else {
                $invoice->status = 'PARTIALLY_PAID';
            }

            $invoice->save();

            return $collection;
        });
    }
}