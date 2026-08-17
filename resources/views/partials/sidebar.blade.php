{{--
|--------------------------------------------------------------------------
| Sidebar Partial - TripWise TNVS
|--------------------------------------------------------------------------
| Usage: @include('partials.sidebar')
| Requires: $currentPage variable (string) from the parent view
--}}

<aside id="navigia-sidebar" class="fixed top-0 left-0 h-full z-40 flex flex-col transition-all duration-300 w-64 overflow-x-hidden" style="background-color:#1c1c1e;">

    <!-- Sidebar Header: Logo & Brand -->
    <div class="flex items-center gap-3 px-4 py-5 border-b border-white/10 flex-shrink-0 overflow-hidden">
        <a href="{{ url('/') }}" class="flex items-center gap-3 min-w-0">
            <div class="w-9 h-9 overflow-hidden rounded-xl border border-[#F44336]/40 bg-white flex-shrink-0 flex items-center justify-center p-0.5">
                <img src="{{ asset('tripwise_icon.png') }}" alt="TripWise" class="w-full h-full object-contain">
            </div>
            <span class="sidebar-text text-lg font-extrabold text-white tracking-tight truncate" style="font-family:'Outfit',sans-serif;">
                TripWise<span style="color:#F44336;">.</span>
            </span>
        </a>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1" id="sidebar-nav">

        <!-- Overview -->
        <a href="{{ url('/dashboard') }}"
           class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 group {{ (isset($currentPage) && $currentPage === 'dashboard') ? 'bg-[#F44336] text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            <span class="sidebar-text truncate">Dashboard</span>
        </a>



        <!-- Divider Label -->
        <div class="px-3 pt-4 pb-1">
            <span class="sidebar-text text-[10px] font-bold uppercase tracking-widest text-white/30">TNVS Systems</span>
        </div>

        <!-- 1. General Ledger -->
        <div class="sidebar-group">
            <button onclick="toggleGroup('gl-group')"
                class="sidebar-link w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 text-white/80 hover:bg-white/10 hover:text-white {{ (isset($currentPage) && $currentPage === 'gl') ? 'bg-white/10 text-white' : '' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                <span class="sidebar-text flex-1 text-left truncate">General Ledger</span>
                <svg class="sidebar-text w-3 h-3 flex-shrink-0 transition-transform duration-200" id="gl-group-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div id="gl-group" class="hidden ml-4 mt-1 space-y-0.5 border-l border-white/10 pl-3">
                <a href="#" class="block text-xs text-white/60 hover:text-white py-1.5 transition-colors">Chart of Accounts</a>
                <a href="#" class="block text-xs text-white/60 hover:text-white py-1.5 transition-colors">Journal Entries</a>
                <a href="#" class="block text-xs text-white/60 hover:text-white py-1.5 transition-colors">Ledger Accounts</a>
                <a href="#" class="block text-xs text-white/60 hover:text-white py-1.5 transition-colors">Trial Balance</a>
            </div>
        </div>

        <!-- 2. Accounts Payable -->
        <div class="sidebar-group">
            <button onclick="toggleGroup('ap-group')"
                class="sidebar-link w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 text-white/80 hover:bg-white/10 hover:text-white {{ (isset($currentPage) && $currentPage === 'ap') ? 'bg-white/10 text-white' : '' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <span class="sidebar-text flex-1 text-left truncate">Accounts Payable</span>
                <svg class="sidebar-text w-3 h-3 flex-shrink-0 transition-transform duration-200" id="ap-group-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div id="ap-group" class="{{ (isset($currentPage) && $currentPage === 'ap') ? '' : 'hidden' }} ml-4 mt-1 space-y-0.5 border-l border-white/10 pl-3">
                <a href="{{ url('/ap/entry') }}" class="block text-xs text-white/60 hover:text-white py-1.5 transition-colors">AP Entry</a>
                <a href="{{ url('/ap/ledger') }}" class="block text-xs text-white/60 hover:text-white py-1.5 transition-colors">AP Ledger</a>
            </div>
        </div>

        <!-- 3. Accounts Receivable -->
        <div class="sidebar-group">
            <button onclick="toggleGroup('ar-group')"
                class="sidebar-link w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 text-white/80 hover:bg-white/10 hover:text-white {{ (isset($currentPage) && $currentPage === 'ar') ? 'bg-white/10 text-white' : '' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="sidebar-text flex-1 text-left truncate">Accounts Receivable</span>
                <svg class="sidebar-text w-3 h-3 flex-shrink-0 transition-transform duration-200" id="ar-group-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div id="ar-group" class="{{ (isset($currentPage) && $currentPage === 'ar') ? '' : 'hidden' }} ml-4 mt-1 space-y-0.5 border-l border-white/10 pl-3">
                <a href="{{ url('/ar') }}" class="block text-xs text-white/60 hover:text-white py-1.5 transition-colors {{ (isset($currentPage) && $currentPage === 'ar') ? 'text-white font-bold' : '' }}">AR Dashboard & Payers</a>
                <a href="{{ url('/invoices') }}" class="block text-xs text-white/60 hover:text-white py-1.5 transition-colors">Invoices List</a>
            </div>
        </div>

        <!-- 4. Disbursement Management -->
        <div class="sidebar-group">
            <button onclick="toggleGroup('disbursement-group')"
                class="sidebar-link w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 text-white/80 hover:bg-white/10 hover:text-white">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <span class="sidebar-text flex-1 text-left truncate">Disbursement Management</span>
                <svg class="sidebar-text w-3 h-3 flex-shrink-0 transition-transform duration-200" id="disbursement-group-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div id="disbursement-group" class="hidden ml-4 mt-1 space-y-0.5 border-l border-white/10 pl-3">
                <a href="#" class="block text-xs text-white/60 hover:text-white py-1.5 transition-colors">Payment Vouchers</a>
                <a href="#" class="block text-xs text-white/60 hover:text-white py-1.5 transition-colors">Check Management</a>
                <a href="#" class="block text-xs text-white/60 hover:text-white py-1.5 transition-colors">Disbursement Approvals</a>
            </div>
        </div>

        <!-- 5. Collection Management -->
        <div class="sidebar-group">
            <button onclick="toggleGroup('collections-group')"
                class="sidebar-link w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 text-white/80 hover:bg-white/10 hover:text-white {{ (isset($currentPage) && $currentPage === 'collections') ? 'bg-white/10 text-white' : '' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="sidebar-text flex-1 text-left truncate">Collection Management</span>
                <svg class="sidebar-text w-3 h-3 flex-shrink-0 transition-transform duration-200" id="collections-group-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div id="collections-group" class="{{ (isset($currentPage) && $currentPage === 'collections') ? '' : 'hidden' }} ml-4 mt-1 space-y-0.5 border-l border-white/10 pl-3">
                <a href="{{ url('/collections') }}" class="block text-xs text-white/60 hover:text-white py-1.5 transition-colors {{ (isset($currentPage) && $currentPage === 'collections') ? 'text-white font-bold' : '' }}">Payment Collections</a>
                <a href="#" class="block text-xs text-white/60 hover:text-white py-1.5 transition-colors">Official Receipts</a>
                <a href="#" class="block text-xs text-white/60 hover:text-white py-1.5 transition-colors">Collector Records</a>
            </div>
        </div>

        <!-- 6. Budget Management -->
        <div class="sidebar-group">
            <button onclick="toggleGroup('budget-group')"
                class="sidebar-link w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 text-white/80 hover:bg-white/10 hover:text-white {{ (isset($currentPage) && $currentPage === 'budget') ? 'bg-white/10 text-white' : '' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
                <span class="sidebar-text flex-1 text-left truncate">Budget Management</span>
                <svg class="sidebar-text w-3 h-3 flex-shrink-0 transition-transform duration-200" id="budget-group-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div id="budget-group" class="{{ (isset($currentPage) && $currentPage === 'budget') ? '' : 'hidden' }} ml-4 mt-1 space-y-0.5 border-l border-white/10 pl-3">
                <a href="{{ url('/budget') }}" class="block text-xs text-white/60 hover:text-white py-1.5 transition-colors {{ (isset($currentPage) && $currentPage === 'budget') ? 'text-white font-bold' : '' }}">Expense Budget Overview</a>
                <a href="{{ url('/budget/export') }}" class="block text-xs text-white/60 hover:text-white py-1.5 transition-colors">Export Budget CSV</a>
            </div>
        </div>

        <!-- 7. Cash Management -->
        <div class="sidebar-group">
            <button onclick="toggleGroup('cash-group')"
                class="sidebar-link w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 text-white/80 hover:bg-white/10 hover:text-white">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/>
                </svg>
                <span class="sidebar-text flex-1 text-left truncate">Cash Management</span>
                <svg class="sidebar-text w-3 h-3 flex-shrink-0 transition-transform duration-200" id="cash-group-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div id="cash-group" class="hidden ml-4 mt-1 space-y-0.5 border-l border-white/10 pl-3">
                <a href="#" class="block text-xs text-white/60 hover:text-white py-1.5 transition-colors">Bank Reconciliation</a>
                <a href="#" class="block text-xs text-white/60 hover:text-white py-1.5 transition-colors">Cash Flow Projection</a>
                <a href="#" class="block text-xs text-white/60 hover:text-white py-1.5 transition-colors">Petty Cash Fund</a>
            </div>
        </div>

        <!-- 8. Financial Reporting and Analytics -->
        <div class="sidebar-group">
            <button onclick="toggleGroup('reporting-group')"
                class="sidebar-link w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 text-white/80 hover:bg-white/10 hover:text-white">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                <span class="sidebar-text flex-1 text-left truncate">Financial Reporting and Analytics</span>
                <svg class="sidebar-text w-3 h-3 flex-shrink-0 transition-transform duration-200" id="reporting-group-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div id="reporting-group" class="hidden ml-4 mt-1 space-y-0.5 border-l border-white/10 pl-3">
                <a href="#" class="block text-xs text-white/60 hover:text-white py-1.5 transition-colors">Income Statement (P&L)</a>
                <a href="#" class="block text-xs text-white/60 hover:text-white py-1.5 transition-colors">Balance Sheet</a>
                <a href="#" class="block text-xs text-white/60 hover:text-white py-1.5 transition-colors">Executive Analytics</a>
            </div>
        </div>

        <!-- 9. Tax Management -->
        <div class="sidebar-group">
            <button onclick="toggleGroup('tax-group')"
                class="sidebar-link w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 text-white/80 hover:bg-white/10 hover:text-white">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span class="sidebar-text flex-1 text-left truncate">Tax Management</span>
                <svg class="sidebar-text w-3 h-3 flex-shrink-0 transition-transform duration-200" id="tax-group-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div id="tax-group" class="hidden ml-4 mt-1 space-y-0.5 border-l border-white/10 pl-3">
                <a href="#" class="block text-xs text-white/60 hover:text-white py-1.5 transition-colors">Tax Rates & Rules</a>
                <a href="#" class="block text-xs text-white/60 hover:text-white py-1.5 transition-colors">BIR Withholding Tax</a>
                <a href="#" class="block text-xs text-white/60 hover:text-white py-1.5 transition-colors">VAT Filings</a>
            </div>
        </div>

    </nav>

    <!-- Sidebar Footer -->
    <div class="flex-shrink-0 px-4 py-4 border-t border-white/10">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-[#F44336]/20 flex items-center justify-center text-[#F44336] text-xs font-bold flex-shrink-0">
                A
            </div>
            <div class="sidebar-text flex-1 min-w-0">
                <p class="text-xs font-bold text-white truncate">Admin User</p>
                <p class="text-[10px] text-white/40 truncate">admin@tripwise.app</p>
            </div>
            <a href="#" class="sidebar-text text-white/40 hover:text-white transition-colors flex-shrink-0" title="Sign out">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
            </a>
        </div>
    </div>

</aside>

<!-- Mobile Sidebar Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden" onclick="closeMobileSidebar()"></div>
