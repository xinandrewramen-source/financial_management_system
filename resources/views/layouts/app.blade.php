<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TNVS Finance System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-800 p-6">

    <div class="max-w-7xl mx-auto space-y-6">
        
        <!-- Header & Navigation Bar -->
        <div class="bg-indigo-900 text-white p-6 rounded-2xl shadow-xl flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h1 class="text-2xl font-black"></h1>
                <p class="text-indigo-200 text-sm">Accounts Receivable, Collections, and AP</p>
            </div>
            
            <!-- Navigation intentionally removed; modules are separate files/folders -->
        </div>

        @if(session('success'))
            <div class="bg-emerald-500 text-white font-bold p-4 rounded-xl shadow-md">
                {{ session('success') }}
            </div>
        @endif

        <!-- Dynamic Content Here -->
        @yield('content')

    </div>

</body>
</html>