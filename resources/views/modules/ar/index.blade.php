@extends('layouts.app')

@section('content')
    <!-- Summary Card -->
    <div class="bg-white p-6 rounded-xl shadow border-l-4 border-rose-500">
        <span class="text-sm text-slate-500 font-bold uppercase">Total Pending Receivables (Utang)</span>
        <p class="text-3xl font-black text-rose-600 mt-1">₱{{ number_format($totalReceivables, 2) }}</p>
    </div>

    <!-- Forms Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Add Payer Form -->
        <div class="bg-white p-5 rounded-xl shadow border">
            <h2 class="text-md font-bold mb-3 text-indigo-900">👤 Add New Payer</h2>
            <form action="/payers" method="POST" class="space-y-3">
                @csrf
                <div>
                    <label class="text-xs font-bold uppercase text-slate-500">Name</label>
                    <input type="text" name="name" required placeholder="Juan Dela Cruz" class="w-full border p-2 rounded text-sm">
                </div>
                <div>
                    <label class="text-xs font-bold uppercase text-slate-500">Type</label>
                    <select name="type" class="w-full border p-2 rounded text-sm">
                        <option value="DRIVER">Driver (Boundary)</option>
                        <option value="CORPORATE_CUSTOMER">Corporate Customer</option>
                        <option value="EMPLOYEE">Employee (CA)</option>
                        <option value="SUPPLIER">Supplier / Insurance</option>
                    </select>
                </div>
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold py-2 rounded">Save Payer</button>
            </form>
        </div>

        <!-- Create Invoice Form -->
        <div class="bg-white p-5 rounded-xl shadow border">
            <h2 class="text-md font-bold mb-3 text-indigo-900">📄 Create AR Invoice</h2>
            <form action="/invoices" method="POST" class="space-y-3">
                @csrf
                <div>
                    <label class="text-xs font-bold uppercase text-slate-500">Select Payer</label>
                    <select name="payer_id" required class="w-full border p-2 rounded text-sm">
                        <option value="">-- Choose Payer --</option>
                        @foreach($payers as $p)
                            <option value="{{ $p->id }}">{{ $p->name }} ({{ $p->type }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-xs font-bold uppercase text-slate-500">Category</label>
                    <select name="ar_category" class="w-full border p-2 rounded text-sm">
                        <option value="BOUNDARY">Boundary / Fleet Fee</option>
                        <option value="CORPORATE_BILLING">Corporate Billing</option>
                        <option value="CASH_ADVANCE">Cash Advance</option>
                        <option value="INSURANCE_CLAIM">Insurance Claim</option>
                        <option value="OTHER">Other</option>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="text-xs font-bold uppercase text-slate-500">Amount (₱)</label>
                        <input type="number" step="0.01" name="total_amount" required placeholder="1000.00" class="w-full border p-2 rounded text-sm">
                    </div>
                    <div>
                        <label class="text-xs font-bold uppercase text-slate-500">Due Date</label>
                        <input type="date" name="due_date" required class="w-full border p-2 rounded text-sm">
                    </div>
                </div>
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold py-2 rounded">Generate Invoice</button>
            </form>
        </div>
    </div>

    <!-- Invoices Table -->
    <div class="bg-white p-6 rounded-xl shadow border">
        <h2 class="text-lg font-bold mb-4 text-slate-800">📊 Accounts Receivable Invoices</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-slate-100 border-b">
                        <th class="p-3">Invoice No.</th>
                        <th class="p-3">Payer Name</th>
                        <th class="p-3">Category</th>
                        <th class="p-3">Total Amount</th>
                        <th class="p-3">Paid Amount</th>
                        <th class="p-3">Balance Due</th>
                        <th class="p-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($invoices as $inv)
                        <tr class="border-b hover:bg-slate-50">
                            <td class="p-3 font-semibold">{{ $inv->invoice_number }}</td>
                            <td class="p-3">{{ $inv->payer->name }} <span class="text-xs text-slate-400">({{ $inv->payer->type }})</span></td>
                            <td class="p-3"><span class="bg-slate-200 text-slate-700 px-2 py-0.5 rounded text-xs font-bold">{{ $inv->ar_category }}</span></td>
                            <td class="p-3 font-bold">₱{{ number_format($inv->total_amount, 2) }}</td>
                            <td class="p-3 text-emerald-600 font-bold">₱{{ number_format($inv->paid_amount, 2) }}</td>
                            <td class="p-3 text-rose-600 font-bold">₱{{ number_format($inv->total_amount - $inv->paid_amount, 2) }}</td>
                            <td class="p-3">
                                <span class="px-2.5 py-1 text-xs font-black rounded-full 
                                    {{ $inv->status == 'PAID' ? 'bg-emerald-100 text-emerald-700' : ($inv->status == 'PARTIAL' ? 'bg-amber-100 text-amber-700' : 'bg-rose-100 text-rose-700') }}">
                                    {{ $inv->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="p-4 text-center text-slate-400">No invoices generated yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
