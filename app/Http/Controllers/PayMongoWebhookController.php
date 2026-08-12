<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Invoice;
use Illuminate\Http\Request;

class PayMongoWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->all();
        
        if (isset($payload['data']['attributes']['type']) && $payload['data']['attributes']['type'] === 'link.payment.paid') {
            $paymentData = $payload['data']['attributes']['data'];
            $linkId = $paymentData['attributes']['link_id'] ?? null;
            $amount = $paymentData['attributes']['amount'] / 100;
            $paymentId = $paymentData['id'];

            if ($linkId) {
                $invoice = Invoice::where('paymongo_link_id', $linkId)->first();

                if ($invoice) {
                    Collection::create([
                        'invoice_id' => $invoice->id,
                        'amount_collected' => $amount,
                        'payment_method' => 'GCASH',
                        'reference_no' => 'PAYMONGO-' . $paymentId,
                        'paymongo_payment_id' => $paymentId,
                    ]);

                    $newPaid = $invoice->paid_amount + $amount;
                    $status = ($newPaid >= $invoice->total_amount) ? 'PAID' : 'PARTIAL';

                    $invoice->update([
                        'paid_amount' => $newPaid,
                        'status' => $status,
                    ]);
                }
            }
        }

        return response()->json(['status' => 'success']);
    }
}