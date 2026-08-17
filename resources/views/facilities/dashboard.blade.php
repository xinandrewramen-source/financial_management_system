@extends('layouts.app')

@php
    $pageTitle = 'Facilities & Admin Overview';
    $currentPage = 'facilities-dashboard';
@endphp

@section('content')
<div class="space-y-6">
    
    <!-- Header -->
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <h1 class="text-xl font-extrabold font-outfit text-gray-900 mb-2">Team 8: Facilities & Administrative Management</h1>
        <p class="text-xs text-gray-500 leading-relaxed">
            As the backend and administrative core of the **TripWise TNVS** platform, Team 8 manages structural resource operations, legal compliance, contract workflows, and office security infrastructure. Below, we break down our system's core modules, sub-modules, and integration connections.
        </p>
    </div>

    <!-- 1. System Sub-Modules Grid -->
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <h2 class="text-sm font-bold font-outfit text-gray-900 mb-4 flex items-center gap-2">
            <svg class="w-4 h-4 text-[#F44336]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            System Sub-Modules Definitions
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            
            <!-- Sub-Module 1 -->
            <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                <h3 class="text-xs font-extrabold text-gray-800 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-[#F44336]"></span>
                    Facilities Reservation System
                </h3>
                <ul class="text-[11px] text-gray-500 mt-2 space-y-1 list-disc pl-3">
                    <li>**Space Allocation:** Rest-lounge beds, corporate desks, vehicle washing bays, and parking slot assignments.</li>
                    <li>**Maintenance Dispatch:** Flags cleaning schedules or repair downtime blockouts.</li>
                    <li>**Resource Optimization:** Allocates projectors, meeting gear, and facility resources.</li>
                </ul>
            </div>

            <!-- Sub-Module 2 -->
            <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                <h3 class="text-xs font-extrabold text-gray-800 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-[#F44336]"></span>
                    Visitor Management System
                </h3>
                <ul class="text-[11px] text-gray-500 mt-2 space-y-1 list-disc pl-3">
                    <li>**QR Pass Issuance:** Autogenerates time-bound digital QR passes for site visitors.</li>
                    <li>**Check-In/Out Tracking:** Real-time log database of active external guests at headquarters.</li>
                    <li>**Host Alerts:** Automated email/SMS notifications to employees when visitors arrive.</li>
                </ul>
            </div>

            <!-- Sub-Module 3 -->
            <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                <h3 class="text-xs font-extrabold text-gray-800 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-[#F44336]"></span>
                    Document Management (Archiving)
                </h3>
                <ul class="text-[11px] text-gray-500 mt-2 space-y-1 list-disc pl-3">
                    <li>**Digital Repository:** Standardized storage for policy files, trip receipts, and business memos.</li>
                    <li>**Metadata Tagging:** Elastic indexing of files with secure tagging rules.</li>
                    <li>**Access Control Rules:** Restricts documents view/edit access based on Role-Based Access Control (RBAC).</li>
                </ul>
            </div>

            <!-- Sub-Module 4 -->
            <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                <h3 class="text-xs font-extrabold text-gray-800 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-[#F44336]"></span>
                    Records Retention & Compliance
                </h3>
                <ul class="text-[11px] text-gray-500 mt-2 space-y-1 list-disc pl-3">
                    <li>**Retention Schedules:** Automatic system flags for archiving or safely purging historical data.</li>
                    <li>**Audit Logging:** Logs system audits to ensure compliance with LTFRB and privacy laws.</li>
                    <li>**Compliance Checklist:** Real-time dashboard for standard operational guidelines verification.</li>
                </ul>
            </div>

            <!-- Sub-Module 5 -->
            <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                <h3 class="text-xs font-extrabold text-gray-800 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-[#F44336]"></span>
                    Legal Management System
                </h3>
                <ul class="text-[11px] text-gray-500 mt-2 space-y-1 list-disc pl-3">
                    <li>**Case Tracking:** System log of legal actions, customer disputes, and regulatory reports.</li>
                    <li>**Advisory Ledger:** Digital hub tracking external counsel briefs and advisory opinions.</li>
                    <li>**Dispute Resolution:** Standardizes steps for handling passenger/driver accident claims.</li>
                </ul>
            </div>

            <!-- Sub-Module 6 -->
            <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                <h3 class="text-xs font-extrabold text-gray-800 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-[#F44336]"></span>
                    Contract Management
                </h3>
                <ul class="text-[11px] text-gray-500 mt-2 space-y-1 list-disc pl-3">
                    <li>**E-Signature Hub:** In-app contract distribution and verification for drivers and suppliers.</li>
                    <li>**Leasing tracking:** Monitored milestones for office leases and fleet acquisitions.</li>
                    <li>**Auto-Renewal Alerts:** Email notifications for contract expiry dates.</li>
                </ul>
            </div>

        </div>
    </div>

    <!-- 2. System Cluster Integration Matrix -->
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <h2 class="text-sm font-bold font-outfit text-gray-900 mb-4 flex items-center gap-2">
            <svg class="w-4 h-4 text-[#F44336]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 10.742l-2.618 1.309a1 1 0 000 1.788l2.618 1.309m4-10.742l2.618 1.309a1 1 0 010 1.788l-2.618 1.309M12 7v10m-3-4h6"/></svg>
            Cluster Integration Matrix (Team 8 Connections)
        </h2>
        
        <div class="space-y-3.5">
            <!-- Team 1 -->
            <div class="flex items-start gap-4 p-3 bg-gray-50 rounded-xl border border-gray-100">
                <span class="text-xs font-bold bg-[#1c1c1e] text-white px-2 py-1 rounded flex-shrink-0">T1</span>
                <div>
                    <h4 class="text-xs font-bold text-gray-800">Recruitment & Core HR Integration</h4>
                    <p class="text-[11px] text-gray-500 mt-0.5">Team 8 validates visitor host IDs against the employee database from Team 1; and checks role permissions before allowing access to secure administrative offices.</p>
                </div>
            </div>

            <!-- Team 2 -->
            <div class="flex items-start gap-4 p-3 bg-gray-50 rounded-xl border border-gray-100">
                <span class="text-xs font-bold bg-[#1c1c1e] text-white px-2 py-1 rounded flex-shrink-0">T2</span>
                <div>
                    <h4 class="text-xs font-bold text-gray-800">Workforce Management Integration</h4>
                    <p class="text-[11px] text-gray-500 mt-0.5">Facility security gates (Team 8) feed check-in/out timestamps directly to Team 2's Time and Attendance tracking system.</p>
                </div>
            </div>

            <!-- Team 3 & 4 -->
            <div class="flex items-start gap-4 p-3 bg-gray-50 rounded-xl border border-gray-100">
                <span class="text-xs font-bold bg-[#1c1c1e] text-white px-2 py-1 rounded flex-shrink-0">T3/4</span>
                <div>
                    <h4 class="text-xs font-bold text-gray-800">Talent Development & Payroll integration</h4>
                    <p class="text-[11px] text-gray-500 mt-0.5">Reservations for learning/training rooms are processed in Team 8's Facilities System. Parking lease deductions and document compliance penalties push to Team 4's Payroll deduction service.</p>
                </div>
            </div>

            <!-- Team 5 -->
            <div class="flex items-start gap-4 p-3 bg-gray-50 rounded-xl border border-gray-100">
                <span class="text-xs font-bold bg-[#1c1c1e] text-white px-2 py-1 rounded flex-shrink-0">T5</span>
                <div>
                    <h4 class="text-xs font-bold text-gray-800">Financial Management Integration</h4>
                    <p class="text-[11px] text-gray-500 mt-0.5">Team 8 reports facility rent invoices, contractor payments (from Contract Management), and visitor pass billing logs to Team 5's General Ledger API.</p>
                </div>
            </div>

            <!-- Team 6 & 7 -->
            <div class="flex items-start gap-4 p-3 bg-gray-50 rounded-xl border border-gray-100">
                <span class="text-xs font-bold bg-[#1c1c1e] text-white px-2 py-1 rounded flex-shrink-0">T6/7</span>
                <div>
                    <h4 class="text-xs font-bold text-gray-800">Supply Chain, Fleet & Vehicle Allocation</h4>
                    <p class="text-[11px] text-gray-500 mt-0.5">Bridges supplier contracts with Team 6's inventory tools. Allocates specific parking bays for dispatch fleets managed by Team 7, and archives vehicle titles/registrations.</p>
                </div>
            </div>

            <!-- Team 9 -->
            <div class="flex items-start gap-4 p-3 bg-gray-50 rounded-xl border border-gray-100">
                <span class="text-xs font-bold bg-[#1c1c1e] text-white px-2 py-1 rounded flex-shrink-0">T9</span>
                <div>
                    <h4 class="text-xs font-bold text-gray-800">Driver Operations & Rest Lounges</h4>
                    <p class="text-[11px] text-gray-500 mt-0.5">Intelligent rest bay systems automatically lease driver rest bunks in Team 8 when Team 9 flags a driver as nearing their safety fatigue limit. Incident archives are logged in Document Management.</p>
                </div>
            </div>

            <!-- Team 10 -->
            <div class="flex items-start gap-4 p-3 bg-gray-50 rounded-xl border border-gray-100">
                <span class="text-xs font-bold bg-[#F44336] text-white px-2 py-1 rounded flex-shrink-0">T10</span>
                <div>
                    <h4 class="text-xs font-bold text-gray-800">Passenger Booking & CX Compliance</h4>
                    <p class="text-[11px] text-gray-500 mt-0.5">Team 8's Legal & Compliance module sets the active passenger Terms of Service and handles accident review dispute claims triggered through Team 10's passenger interfaces.</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
