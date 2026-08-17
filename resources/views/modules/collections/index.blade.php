@extends('layouts.app')

@php
    $pageTitle = 'Collection Management';
    $currentPage = 'collections';
@endphp

@section('content')
    <!-- Summary Card -->
    <div class="bg-white p-6 rounded-xl shadow" style="border-left:4px solid #F97316;">
        <span class="text-sm text-slate-500 font-bold uppercase">Total Collected Amount (Na-kolekta)</span>
        <p class="text-3xl font-black text-gray-900 mt-1">₱{{ number_format($totalCollected, 2) }}</p>
    </div>

    <!-- Record Collection Form -->
    <div class="bg-white p-5 rounded-xl shadow border max-w-2xl mx-auto">
        <h2 class="text-md font-bold mb-3 text-gray-800">💰 Record Payment Received</h2>
        <form action="/collections" method="POST" class="space-y-3">
            @csrf
            <div>
                <label class="text-xs font-bold uppercase text-slate-500">Select Invoice</label>
                <select name="invoice_id" required class="w-full border p-2 rounded text-sm">
                    <option value="">-- Choose Unpaid/Partial Invoice --</option>
                    @foreach($invoices as $inv)
                        @if($inv->status != 'PAID')
                            <option value="{{ $inv->id }}">{{ $inv->invoice_number }} - {{ $inv->payer->name }} (Bal: ₱{{ number_format($inv->total_amount - $inv->paid_amount, 2) }})</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                <div>
                    <label class="text-xs font-bold uppercase text-slate-500">Amount (₱)</label>
                    <input type="number" step="0.01" name="amount_collected" required placeholder="500.00" class="w-full border p-2 rounded text-sm">
                </div>
                <div>
                    <label class="text-xs font-bold uppercase text-slate-500">Payment Method</label>
                    <select name="payment_method" class="w-full border p-2 rounded text-sm">
                        <option value="CASH">Cash</option>
                        <option value="GCASH">GCash</option>
                        <option value="MAYA">Maya</option>
                        <option value="BANK_TRANSFER">Bank Deposit / Transfer</option>
                        <option value="CHECK">Check</option>
                    </select>
                </div>
                <div>
                    <label class="text-xs font-bold uppercase text-slate-500">Ref / OR No.</label>
                    <input type="text" name="reference_no" placeholder="OR# 123456" class="w-full border p-2 rounded text-sm">
                </div>
            </div>
            <button type="submit" class="w-full text-white text-sm font-bold py-2 rounded transition-colors" style="background-color:#F97316;" onmouseover="this.style.backgroundColor='#EA580C'" onmouseout="this.style.backgroundColor='#F97316'">Save Collection</button>
        </form>
    </div>

    <!-- Payment History Table -->
    <div class="bg-white p-6 rounded-xl shadow border">
        <h2 class="text-lg font-bold mb-4 text-slate-800">📜 Payment History / Collections Log</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-slate-100 border-b">
                        <th class="p-3">Date</th>
                        <th class="p-3">Invoice No.</th>
                        <th class="p-3">Payer Name</th>
                        <th class="p-3">Amount Collected</th>
                        <th class="p-3">Payment Method</th>
                        <th class="p-3">Reference No.</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($collections as $col)
                        <tr class="border-b hover:bg-slate-50">
                            <td class="p-3 text-slate-500">{{ $col->created_at->format('M d, Y h:i A') }}</td>
                            <td class="p-3 font-semibold">{{ $col->invoice->invoice_number }}</td>
                            <td class="p-3">{{ $col->invoice->payer->name }}</td>
                            <td class="p-3 text-gray-900 font-bold">₱{{ number_format($col->amount_collected, 2) }}</td>
                            <td class="p-3"><span class="bg-slate-100 border text-slate-700 px-2 py-0.5 rounded text-xs font-bold">{{ $col->payment_method }}</span></td>
                            <td class="p-3 text-slate-500 font-mono text-xs">{{ $col->reference_no ?? 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="p-4 text-center text-slate-400">No collections recorded yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
