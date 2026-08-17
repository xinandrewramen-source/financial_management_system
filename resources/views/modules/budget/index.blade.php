@extends('layouts.app')

@php
    $pageTitle = 'Budget Management';
    $currentPage = 'budget';
@endphp

@section('content')
<div class="space-y-6">

    <!-- Page Title Header -->
    <div class="flex justify-between items-center bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Personal & Corporate Budget Tracker</h2>
            <p class="text-sm text-slate-500">Track expenses, import data, and view real-time category analytics</p>
        </div>
        <div class="flex gap-2">
            <a href="/budget/export" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-sm font-semibold shadow transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                Export CSV / Excel
            </a>
        </div>
    </div>

    <!-- 3-Column Dashboard Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        <!-- LEFT COLUMN: Forms & Upload/Download (4 cols) -->
        <div class="lg:col-span-4 space-y-6">

            <!-- Add Expense Card -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 space-y-4">
                <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                    <span class="p-1.5 bg-blue-100 text-blue-600 rounded-lg">➕</span>
                    Add Expense
                </h3>

                <form action="/budget" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-1">Date</label>
                        <input type="date" name="expense_date" value="{{ date('Y-m-d') }}" required class="w-full border border-slate-300 rounded-xl p-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-1">Category</label>
                        <select name="category" required class="w-full border border-slate-300 rounded-xl p-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            @foreach($availableCategories as $cat)
                                <option value="{{ $cat }}">{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-1">Amount (₱)</label>
                        <input type="number" step="0.01" min="0.01" name="amount" placeholder="0.00" required class="w-full border border-slate-300 rounded-xl p-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-1">Description (Optional)</label>
                        <input type="text" name="description" placeholder="e.g. Coffee and snacks, Fuel, Maintenance" class="w-full border border-slate-300 rounded-xl p-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl shadow-md transition duration-150">
                        Add Expense
                    </button>
                </form>
            </div>

            <!-- Upload and Download Card -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 space-y-4">
                <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                    <span class="p-1.5 bg-emerald-100 text-emerald-600 rounded-lg">📁</span>
                    Upload & Import CSV
                </h3>

                <form action="/budget/import" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-1">Select CSV File</label>
                        <input type="file" name="csv_file" accept=".csv" required class="w-full border border-slate-300 rounded-xl p-2 text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>

                    <button type="submit" class="w-full bg-slate-800 hover:bg-slate-900 text-white font-semibold py-2.5 px-4 rounded-xl shadow transition text-sm">
                        Upload expenses.csv
                    </button>
                </form>

                <div class="pt-2 border-t border-slate-100 flex gap-2">
                    <a href="/budget/export" class="w-full text-center border border-blue-600 text-blue-600 hover:bg-blue-50 font-semibold py-2 px-3 rounded-xl transition text-xs">
                        Download / Export to Excel
                    </a>
                </div>
            </div>

        </div>

        <!-- MIDDLE COLUMN: Filters & Transaction Table (4 cols) -->
        <div class="lg:col-span-4 space-y-6">

            <!-- Filters Panel -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 space-y-4">
                <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                    <span class="p-1.5 bg-indigo-100 text-indigo-600 rounded-lg">🔍</span>
                    Filters
                </h3>

                <form method="GET" action="/budget" class="space-y-3">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-1">Category</label>
                        <select name="category" onchange="this.form.submit()" class="w-full border border-slate-300 rounded-xl p-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option value="All" {{ request('category') == 'All' || !request('category') ? 'selected' : '' }}>All Categories</option>
                            @foreach($availableCategories as $cat)
                                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-1">Month</label>
                        <select name="month" onchange="this.form.submit()" class="w-full border border-slate-300 rounded-xl p-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option value="" {{ !request('month') ? 'selected' : '' }}>All Months</option>
                            @foreach($availableMonths as $m)
                                <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>{{ $m }}</option>
                            @endforeach
                        </select>
                    </div>

                    @if(request('category') || request('month'))
                        <div class="pt-1">
                            <a href="/budget" class="text-xs text-rose-600 font-bold hover:underline">Reset Filters</a>
                        </div>
                    @endif
                </form>
            </div>

            <!-- Transaction Table Card -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 space-y-4">
                <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                    <span class="p-1.5 bg-slate-100 text-slate-600 rounded-lg">📋</span>
                    Transaction Table
                </h3>

                <div class="overflow-x-auto max-h-[420px] overflow-y-auto">
                    <table class="w-full text-left text-xs text-slate-600 border-collapse">
                        <thead class="bg-slate-50 sticky top-0 uppercase font-bold text-slate-500 border-b border-slate-200">
                            <tr>
                                <th class="p-2.5">Date</th>
                                <th class="p-2.5">Category</th>
                                <th class="p-2.5">Description</th>
                                <th class="p-2.5 text-right">Amount</th>
                                <th class="p-2.5 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($expenses as $exp)
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="p-2.5 whitespace-nowrap font-medium text-slate-700">{{ $exp->expense_date->format('Y-m-d') }}</td>
                                    <td class="p-2.5 whitespace-nowrap">
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                            {{ $exp->category }}
                                        </span>
                                    </td>
                                    <td class="p-2.5 truncate max-w-[120px]" title="{{ $exp->description }}">{{ $exp->description ?? '-' }}</td>
                                    <td class="p-2.5 text-right font-bold text-slate-900 whitespace-nowrap">₱{{ number_format($exp->amount, 2) }}</td>
                                    <td class="p-2.5 text-center">
                                        <form action="/budget/{{ $exp->id }}" method="POST" onsubmit="return confirm('Delete this expense?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-rose-500 hover:text-rose-700 font-bold text-xs p-1">
                                                &times;
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-6 text-center text-slate-400 italic">No expenses recorded yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- RIGHT COLUMN: KPI Summary & Charts (4 cols) -->
        <div class="lg:col-span-4 space-y-6">

            <!-- Summary KPI Card -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-2xl border border-blue-100 shadow-sm space-y-2">
                <span class="text-xs font-bold uppercase tracking-wider text-blue-600">Summary</span>
                <p class="text-sm text-slate-500 font-medium">Total Spending</p>
                <div class="text-3xl font-black text-slate-900 tracking-tight">
                    ₱{{ number_format($totalSpending, 2) }}
                </div>
            </div>

            <!-- Expenses by Category (Pie Chart) -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 space-y-4">
                <h3 class="text-lg font-bold text-slate-800">Expenses by Category</h3>
                <div class="w-full h-56 flex justify-center items-center">
                    <canvas id="categoryPieChart"></canvas>
                </div>
            </div>

            <!-- Spending Over Time (Line Chart) -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 space-y-4">
                <h3 class="text-lg font-bold text-slate-800">Spending Over Time</h3>
                <div class="w-full h-52 flex justify-center items-center">
                    <canvas id="spendingLineChart"></canvas>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- Chart.js Initialization -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // 1. Pie Chart - Expenses by Category
        const categoryData = @json($categoryBreakdown);
        const pieLabels = Object.keys(categoryData);
        const pieValues = Object.values(categoryData);

        const pieCtx = document.getElementById('categoryPieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'doughnut',
            data: {
                labels: pieLabels.length > 0 ? pieLabels : ['No Data'],
                datasets: [{
                    data: pieValues.length > 0 ? pieValues : [1],
                    backgroundColor: [
                        '#3b82f6', // blue
                        '#06b6d4', // cyan
                        '#8b5cf6', // purple
                        '#f59e0b', // amber
                        '#10b981', // emerald
                        '#ec4899', // pink
                        '#64748b'  // slate
                    ],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: { size: 11, weight: '600' },
                            padding: 12,
                            boxWidth: 12
                        }
                    }
                }
            }
        });

        // 2. Line Chart - Spending Over Time
        const monthlyData = @json($monthlyTrend);
        const lineLabels = monthlyData.map(item => item.month_label);
        const lineValues = monthlyData.map(item => parseFloat(item.total));

        const lineCtx = document.getElementById('spendingLineChart').getContext('2d');
        new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: lineLabels.length > 0 ? lineLabels : ['Current'],
                datasets: [{
                    label: 'Total Spent (₱)',
                    data: lineValues.length > 0 ? lineValues : [0],
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37, 99, 235, 0.1)',
                    fill: true,
                    tension: 0.3,
                    pointRadius: 4,
                    pointBackgroundColor: '#2563eb'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f1f5f9' },
                        ticks: { font: { size: 10 } }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 10 } }
                    }
                }
            }
        });
    });
</script>
@endsection
