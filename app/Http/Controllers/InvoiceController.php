<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payer;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $payers = Payer::orderBy('name')->get();
        $invoices = Invoice::with('payer')->orderBy('created_at', 'desc')->get();
        $totalReceivables = Invoice::sum('total_amount') - Invoice::sum('paid_amount');

        return view('modules.ar.index', compact('payers', 'invoices', 'totalReceivables'));
    }

    public function storePayer(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'type' => 'required|in:DRIVER,CORPORATE_CUSTOMER,EMPLOYEE,SUPPLIER',
        ]);

        Payer::create($request->all());

        return redirect()->back()->with('success', 'Payer added successfully!');
    }

    public function storeInvoice(Request $request)
    {
        $request->validate([
            'payer_id' => 'required|exists:payers,id',
            'ar_category' => 'required|string',
            'total_amount' => 'required|numeric|min:1',
            'due_date' => 'required|date',
        ]);

        $invoiceNum = 'INV-' . strtoupper(uniqid());

        Invoice::create([
            'payer_id' => $request->payer_id,
            'invoice_number' => $invoiceNum,
            'ar_category' => $request->ar_category,
            'total_amount' => $request->total_amount,
            'due_date' => $request->due_date,
        ]);

        return redirect()->back()->with('success', 'Invoice created successfully!');
    }
}