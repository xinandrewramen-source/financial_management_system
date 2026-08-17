@extends('layouts.app')

@php
    $pageTitle = 'AP Ledger';
    $currentPage = 'ap';
@endphp

@section('content')

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-xl font-extrabold font-outfit text-gray-900">AP Ledger</h1>
            <p class="text-xs text-gray-500 mt-0.5">All payable invoices and their current payment status.</p>
        </div>
        <a href="{{ url('/ap/entry') }}" class="flex items-center gap-2 text-xs font-semibold text-indigo-600 bg-indigo-50 border border-indigo-200 px-3 py-1.5 rounded-full hover:bg-indigo-100 transition-colors">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            New AP Entry →
        </a>
    </div>

    {{-- Summary Card --}}
    <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-indigo-500 mb-6">
        <span class="text-sm text-slate-500 font-bold uppercase tracking-wide">Total Outstanding Payables</span>
        <p class="text-3xl font-black text-indigo-600 mt-1">₱{{ number_format($totalPayables, 2) }}</p>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-xl mb-4">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- AP Invoices Table --}}
    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
        <div class="bg-slate-50 px-6 py-4 border-b flex items-center justify-between">
            <h2 class="text-base font-bold text-slate-800">📋 Payable Invoices</h2>
            <span class="text-xs text-slate-400">{{ $apInvoices->count() }} invoice(s) found</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b text-xs font-bold uppercase text-slate-500">
                        <th class="px-4 py-3">Invoice No.</th>
                        <th class="px-4 py-3">Supplier</th>
                        <th class="px-4 py-3">Total Amount</th>
                        <th class="px-4 py-3">Paid</th>
                        <th class="px-4 py-3">Balance</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Due Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($apInvoices as $invoice)
                        <tr class="border-b hover:bg-slate-50 transition-colors">
                            <td class="px-4 py-3 font-mono text-xs font-semibold text-slate-700">{{ $invoice->invoice_number }}</td>
                            <td class="px-4 py-3 font-semibold text-slate-800">{{ $invoice->supplier->name }}</td>
                            <td class="px-4 py-3 text-slate-700">₱{{ number_format($invoice->total_amount, 2) }}</td>
                            <td class="px-4 py-3 text-emerald-600 font-semibold">₱{{ number_format($invoice->paid_amount, 2) }}</td>
                            <td class="px-4 py-3 text-red-600 font-bold">₱{{ number_format($invoice->balance, 2) }}</td>
                            <td class="px-4 py-3">
                                @if($invoice->status === 'PAID')
                                    <span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-2 py-0.5 rounded-full">PAID</span>
                                @elseif($invoice->status === 'PARTIAL')
                                    <span class="bg-amber-100 text-amber-700 text-xs font-bold px-2 py-0.5 rounded-full">PARTIAL</span>
                                @else
                                    <span class="bg-red-100 text-red-700 text-xs font-bold px-2 py-0.5 rounded-full">UNPAID</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-slate-500 text-xs">{{ $invoice->due_date ? $invoice->due_date->format('M d, Y') : 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-slate-400">
                                <div class="flex flex-col items-center gap-2">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    <span class="text-sm">No AP invoices yet. <a href="{{ url('/ap/entry') }}" class="text-indigo-600 hover:underline">Create one →</a></span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Suppliers Table --}}
    <div class="bg-white rounded-xl shadow-sm border overflow-hidden mt-6">
        <div class="bg-slate-50 px-6 py-4 border-b">
            <h2 class="text-base font-bold text-slate-800">🏢 Registered Suppliers</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b text-xs font-bold uppercase text-slate-500">
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Contact Person</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Phone</th>
                        <th class="px-4 py-3">Payment Terms</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suppliers as $supplier)
                        <tr class="border-b hover:bg-slate-50 transition-colors">
                            <td class="px-4 py-3 font-semibold text-slate-800">{{ $supplier->name }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $supplier->contact_person ?? '—' }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $supplier->email ?? '—' }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $supplier->phone ?? '—' }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $supplier->payment_terms_days ?? 30 }} days</td>
                            <td class="px-4 py-3 flex items-center gap-2">
                                <a href="/ap/suppliers/{{ $supplier->id }}/edit" class="text-xs text-blue-600 hover:underline font-semibold">Edit</a>
                                <form action="/ap/suppliers/{{ $supplier->id }}" method="POST" onsubmit="return confirm('Delete this supplier?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-xs text-red-500 hover:underline font-semibold">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-slate-400 text-sm">No suppliers registered yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
