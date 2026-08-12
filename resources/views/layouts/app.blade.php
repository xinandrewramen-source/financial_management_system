<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance System - Budget & Financial Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-slate-50 text-slate-800 p-6 min-h-screen">

    <div class="max-w-7xl mx-auto space-y-6">
        
        <!-- Header & Navigation Bar -->
        <div class="bg-indigo-900 text-white p-6 rounded-2xl shadow-xl flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h1 class="text-2xl font-black tracking-tight">Finance System</h1>
                <p class="text-indigo-200 text-sm">Accounts Receivable, Collections, AP & Budget Management</p>
            </div>
            
            <!-- Navigation Links -->
            <nav class="flex flex-wrap gap-2 text-sm font-semibold">
                <a href="/ar" class="px-4 py-2 rounded-xl transition {{ request()->is('ar', 'invoices', '/') ? 'bg-white text-indigo-900 shadow-md font-bold' : 'bg-indigo-800/60 text-indigo-100 hover:bg-indigo-800' }}">
                    Receivables (AR)
                </a>
                <a href="/collections" class="px-4 py-2 rounded-xl transition {{ request()->is('collections*') ? 'bg-white text-indigo-900 shadow-md font-bold' : 'bg-indigo-800/60 text-indigo-100 hover:bg-indigo-800' }}">
                    Collections
                </a>
                <a href="/ap" class="px-4 py-2 rounded-xl transition {{ request()->is('ap*') ? 'bg-white text-indigo-900 shadow-md font-bold' : 'bg-indigo-800/60 text-indigo-100 hover:bg-indigo-800' }}">
                    Payables (AP)
                </a>
                <a href="/budget" class="px-4 py-2 rounded-xl transition {{ request()->is('budget*') ? 'bg-white text-indigo-900 shadow-md font-bold' : 'bg-indigo-800/60 text-indigo-100 hover:bg-indigo-800' }}">
                    📊 Budget Management
                </a>
            </nav>
        </div>

        @if(session('success'))
            <div class="bg-emerald-500 text-white font-bold p-4 rounded-xl shadow-md flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-emerald-100 hover:text-white">&times;</button>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-rose-500 text-white font-bold p-4 rounded-xl shadow-md space-y-1">
                @foreach($errors->all() as $error)
                    <div>• {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <!-- Dynamic Content Here -->
        @yield('content')

    </div>

</body>
</html>