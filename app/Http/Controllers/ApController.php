<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\ApInvoice;
use App\Models\ApPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApController extends Controller
{
    public function index(Request $request)
    {
        $suppliers = Supplier::orderBy('name')->get();
        $apInvoices = ApInvoice::with('supplier')->orderBy('created_at', 'desc')->get();
        $totalPayables = ApInvoice::sum('balance');

        return view('modules.ap.index', compact('suppliers', 'apInvoices', 'totalPayables'));
    }

    public function entry(Request $request)
    {
        $suppliers = Supplier::orderBy('name')->get();
        $totalPayables = ApInvoice::sum('balance');

        return view('modules.ap.entry', compact('suppliers', 'totalPayables'));
    }

    public function ledger(Request $request)
    {
        $suppliers = Supplier::orderBy('name')->get();
        $apInvoices = ApInvoice::with('supplier')->orderBy('created_at', 'desc')->get();
        $totalPayables = ApInvoice::sum('balance');

        return view('modules.ap.ledger', compact('suppliers', 'apInvoices', 'totalPayables'));
    }

    public function storeSupplier(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'contact_person' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'payment_terms_days' => 'nullable|integer|min:0',
        ]);

        Supplier::create($request->all());

        return redirect()->back()->with('success', 'Supplier added successfully!');
    }

    public function storeInvoice(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'total_amount' => 'required|numeric|min:1|max:999999999999.99',
            'issue_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:issue_date',
            'description' => 'nullable|string',
        ]);

        $invoiceNumber = 'AP-' . strtoupper(uniqid());

        ApInvoice::create([
            'supplier_id' => $request->supplier_id,
            'invoice_number' => $invoiceNumber,
            'total_amount' => $request->total_amount,
            'paid_amount' => 0,
            'balance' => $request->total_amount,
            'status' => 'UNPAID',
            'issue_date' => $request->issue_date,
            'due_date' => $request->due_date,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'AP invoice created successfully!');
    }

    public function storePayment(Request $request)
    {
        $request->validate([
            'ap_invoice_id' => 'required|exists:ap_invoices,id',
            'amount_paid' => 'required|numeric|min:0.01|max:999999999999.99',
            'payment_method' => 'required|string',
            'reference_number' => 'nullable|string',
            'payment_date' => 'required|date',
        ]);

        return DB::transaction(function () use ($request) {
            $invoice = ApInvoice::findOrFail($request->ap_invoice_id);

            ApPayment::create([
                'ap_invoice_id' => $invoice->id,
                'supplier_id' => $invoice->supplier_id,
                'amount_paid' => $request->amount_paid,
                'payment_method' => $request->payment_method,
                'reference_number' => $request->reference_number,
                'payment_date' => $request->payment_date,
            ]);

            $newPaid = $invoice->paid_amount + $request->amount_paid;
            $newBalance = max(0, $invoice->total_amount - $newPaid);
            $status = $newBalance <= 0 ? 'PAID' : 'PARTIAL';

            $invoice->update([
                'paid_amount' => $newPaid,
                'balance' => $newBalance,
                'status' => $status,
            ]);

            return redirect()->back()->with('success', 'Payment recorded successfully!');
        });
    }

    public function edit(Supplier $supplier)
    {
        $suppliers = Supplier::orderBy('name')->get();
        $apInvoices = ApInvoice::with('supplier')->orderBy('created_at', 'desc')->get();
        $totalPayables = ApInvoice::sum('balance');

        return view('ap.edit_supplier', compact('supplier', 'suppliers', 'apInvoices', 'totalPayables'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required|string',
            'contact_person' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'payment_terms_days' => 'nullable|integer|min:0',
        ]);

        $supplier->update($request->all());

        return redirect('/ap')->with('success', 'Supplier updated successfully!');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect('/ap')->with('success', 'Supplier deleted successfully!');
    }
}
