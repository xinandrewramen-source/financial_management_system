<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Invoice;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('payer')->where('status', '!=', 'PAID')->orderBy('created_at', 'desc')->get();
        $collections = Collection::with('invoice.payer')->orderBy('created_at', 'desc')->get();
        $totalCollected = Collection::sum('amount_collected');

        return view('modules.collections.index', compact('invoices', 'collections', 'totalCollected'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'amount_collected' => 'required|numeric|min:1|max:999999999999.99',
            'payment_method' => 'required|string',
        ]);

        $invoice = Invoice::findOrFail($request->invoice_id);

        Collection::create([
            'invoice_id' => $invoice->id,
            'amount_collected' => $request->amount_collected,
            'payment_method' => $request->payment_method,
            'reference_no' => $request->reference_no ?? 'REF-' . time(),
        ]);

        $newPaidAmount = $invoice->paid_amount + $request->amount_collected;
        $status = ($newPaidAmount >= $invoice->total_amount) ? 'PAID' : 'PARTIAL';

        $invoice->update([
            'paid_amount' => $newPaidAmount,
            'status' => $status
        ]);

        return redirect()->back()->with('success', 'Collection recorded successfully!');
    }
}