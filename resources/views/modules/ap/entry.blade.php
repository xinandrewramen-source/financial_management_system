@extends('layouts.app')

@php
    $pageTitle = 'AP Entry';
    $currentPage = 'ap';
@endphp

@section('content')

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-xl font-extrabold font-outfit text-gray-900">AP Entry</h1>
            <p class="text-xs text-gray-500 mt-0.5">Register suppliers and create new payable invoices.</p>
        </div>
        <a href="{{ url('/ap/ledger') }}" class="flex items-center gap-2 text-xs font-semibold px-3 py-1.5 rounded-full transition-colors" style="color:#F44336; background-color:#fff5f5; border:1px solid rgba(244,67,54,0.3);" onmouseover="this.style.backgroundColor='#fee2e2'" onmouseout="this.style.backgroundColor='#fff5f5'">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            View AP Ledger →
        </a>
    </div>

    {{-- Summary Card --}}
    <div class="bg-white p-6 rounded-xl shadow-sm mb-6" style="border-left:4px solid #F44336;">
        <span class="text-sm text-slate-500 font-bold uppercase tracking-wide">Total Outstanding Payables</span>
        <p class="text-3xl font-black mt-1" style="color:#F44336;">₱{{ number_format($totalPayables, 2) }}</p>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-xl mb-4">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Add Supplier Form --}}
        <div class="bg-white rounded-xl shadow-sm border p-6">
            <h2 class="text-lg font-bold mb-1 text-slate-800">🏢 Register Supplier</h2>
            <p class="text-xs text-slate-400 mb-4">Add a new vendor or service provider to the system.</p>
            <form action="/ap/suppliers" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Supplier Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" class="w-full border border-slate-200 p-2.5 rounded-lg text-sm focus:ring-2 focus:ring-indigo-300 focus:outline-none" required placeholder="e.g. ABC Supplies Inc.">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Contact Person</label>
                    <input type="text" name="contact_person" class="w-full border border-slate-200 p-2.5 rounded-lg text-sm focus:ring-2 focus:ring-indigo-300 focus:outline-none" placeholder="e.g. Juan Dela Cruz">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Email</label>
                        <input type="email" name="email" class="w-full border border-slate-200 p-2.5 rounded-lg text-sm focus:ring-2 focus:ring-indigo-300 focus:outline-none" placeholder="supplier@email.com">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Phone</label>
                        <input type="text" name="phone" class="w-full border border-slate-200 p-2.5 rounded-lg text-sm focus:ring-2 focus:ring-indigo-300 focus:outline-none" placeholder="09XX-XXX-XXXX">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Address</label>
                    <textarea name="address" rows="2" class="w-full border border-slate-200 p-2.5 rounded-lg text-sm focus:ring-2 focus:ring-indigo-300 focus:outline-none" placeholder="Business address..."></textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Payment Terms (days)</label>
                    <input type="number" name="payment_terms_days" class="w-full border border-slate-200 p-2.5 rounded-lg text-sm focus:ring-2 focus:ring-indigo-300 focus:outline-none" value="30">
                </div>
                <button type="submit" class="w-full text-white text-sm font-bold py-2.5 rounded-lg transition-colors" style="background-color:#F44336;" onmouseover="this.style.backgroundColor='#D32F2F'" onmouseout="this.style.backgroundColor='#F44336'">
                    Save Supplier
                </button>
            </form>
        </div>

        {{-- Create AP Invoice Form --}}
        <div class="bg-white rounded-xl shadow-sm border p-6">
            <h2 class="text-lg font-bold mb-1 text-slate-800">📄 Create AP Invoice</h2>
            <p class="text-xs text-slate-400 mb-4">Log a new payable invoice from a registered supplier.</p>
            <form action="/ap/invoices" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Supplier <span class="text-red-500">*</span></label>
                    <select name="supplier_id" class="w-full border border-slate-200 p-2.5 rounded-lg text-sm focus:ring-2 focus:ring-indigo-300 focus:outline-none" required>
                        <option value="">— Select Supplier —</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Total Amount (₱) <span class="text-red-500">*</span></label>
                        <input type="number" step="0.01" name="total_amount" class="w-full border border-slate-200 p-2.5 rounded-lg text-sm focus:ring-2 focus:ring-indigo-300 focus:outline-none" required placeholder="0.00">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Issue Date <span class="text-red-500">*</span></label>
                        <input type="date" name="issue_date" class="w-full border border-slate-200 p-2.5 rounded-lg text-sm focus:ring-2 focus:ring-indigo-300 focus:outline-none" required>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Due Date <span class="text-red-500">*</span></label>
                        <input type="date" name="due_date" class="w-full border border-slate-200 p-2.5 rounded-lg text-sm focus:ring-2 focus:ring-indigo-300 focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Description</label>
                        <input type="text" name="description" class="w-full border border-slate-200 p-2.5 rounded-lg text-sm focus:ring-2 focus:ring-indigo-300 focus:outline-none" placeholder="Invoice note...">
                    </div>
                </div>
                <button type="submit" class="w-full text-white text-sm font-bold py-2.5 rounded-lg transition-colors" style="background-color:#F44336;" onmouseover="this.style.backgroundColor='#D32F2F'" onmouseout="this.style.backgroundColor='#F44336'">
                    Create Invoice
                </button>
            </form>
        </div>

    </div>
@endsection
