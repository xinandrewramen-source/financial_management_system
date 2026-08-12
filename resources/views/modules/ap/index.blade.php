@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">Accounts Payable</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
        <div class="bg-white p-6 rounded-xl shadow border-l-4 border-indigo-500">
            <p class="text-gray-600 text-sm">Total Payables</p>
            <p class="text-3xl font-bold text-indigo-600">₱{{ number_format($totalPayables, 2) }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-8">
        <div class="bg-white rounded-xl shadow border p-6">
            <h2 class="text-xl font-bold mb-4">Add Supplier</h2>
            <form action="/ap/suppliers" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-slate-700">Supplier Name</label>
                    <input type="text" name="name" class="w-full border p-2 rounded" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700">Contact Person</label>
                    <input type="text" name="contact_person" class="w-full border p-2 rounded">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-bold text-slate-700">Email</label>
                        <input type="email" name="email" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700">Phone</label>
                        <input type="text" name="phone" class="w-full border p-2 rounded">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700">Address</label>
                    <textarea name="address" class="w-full border p-2 rounded"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700">Payment Terms (days)</label>
                    <input type="number" name="payment_terms_days" class="w-full border p-2 rounded" value="30">
                </div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save Supplier</button>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow border p-6">
            <h2 class="text-xl font-bold mb-4">Create AP Invoice</h2>
            <form action="/ap/invoices" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-slate-700">Supplier</label>
                    <select name="supplier_id" class="w-full border p-2 rounded" required>
                        <option value="">Select supplier</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-bold text-slate-700">Total Amount</label>
                        <input type="number" step="0.01" name="total_amount" class="w-full border p-2 rounded" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700">Issue Date</label>
                        <input type="date" name="issue_date" class="w-full border p-2 rounded" required>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-bold text-slate-700">Due Date</label>
                        <input type="date" name="due_date" class="w-full border p-2 rounded" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700">Description</label>
                        <input type="text" name="description" class="w-full border p-2 rounded">
                    </div>
                </div>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Create Invoice</button>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow border overflow-hidden">
        <div class="bg-slate-100 px-6 py-4 border-b">
            <h2 class="text-lg font-bold">Payable Invoices</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b">
                        <th class="px-4 py-3">Invoice No.</th>
                        <th class="px-4 py-3">Supplier</th>
                        <th class="px-4 py-3">Total</th>
                        <th class="px-4 py-3">Paid</th>
                        <th class="px-4 py-3">Balance</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Due Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($apInvoices as $invoice)
                        <tr class="border-b hover:bg-slate-50">
                            <td class="px-4 py-3">{{ $invoice->invoice_number }}</td>
                            <td class="px-4 py-3">{{ $invoice->supplier->name }}</td>
                            <td class="px-4 py-3">₱{{ number_format($invoice->total_amount, 2) }}</td>
                            <td class="px-4 py-3">₱{{ number_format($invoice->paid_amount, 2) }}</td>
                            <td class="px-4 py-3">₱{{ number_format($invoice->balance, 2) }}</td>
                            <td class="px-4 py-3">{{ $invoice->status }}</td>
                            <td class="px-4 py-3">{{ $invoice->due_date ? $invoice->due_date->format('M d, Y') : 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-3 text-center text-gray-500">No AP invoices yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
