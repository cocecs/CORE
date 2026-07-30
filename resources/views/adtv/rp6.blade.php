<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold leading-tight text-gray-800">
            {{ __('List of Posted Jobs') }}
        </h2>
    </x-slot>

@csrf
<!-- KPI Cards Summary Section -->
<div class="max-w-6xl mx-auto space-y-8">

        <!-- Page Title Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-[#e2e8f0] dark:border-[#2a2a28] pb-5">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">
                    Key Performance Indicators (KPI)
                </h1>
                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mt-1">
                    High-level metrics and placement summary across all job applications.
                </p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('rp5') }}" class="px-4 py-2 bg-slate-100 dark:bg-[#1f1f1e] hover:bg-slate-200 dark:hover:bg-[#2a2a28] text-xs font-semibold rounded-lg transition border border-[#e2e8f0] dark:border-[#2a2a28]">
                    View Barangay Report &rarr;
                </a>
                <button onclick="window.print()" class="px-4 py-2 bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white text-xs font-semibold rounded-lg shadow transition duration-200">
                    Print KPI Summary
                </button>
            </div>
        </div>

        <!-- KPI Grid Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

            <!-- Card 1: Total Applications -->
            <div class="p-5 rounded-xl bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#3E3E3A] shadow-sm flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold uppercase tracking-wider text-[#706f6c] dark:text-[#A1A09A]">
                        Total Applications
                    </span>
                    <span class="p-2 rounded-lg bg-orange-100 dark:bg-orange-950/40 text-orange-600 dark:text-orange-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </span>
                </div>
                <div class="mt-4">
                    <p class="text-3xl font-extrabold text-[#1b1b18] dark:text-[#EDEDEC]">
                        {{ number_format($totalApplications) }}
                    </p>
                    <p class="text-xs text-[#706f6c] dark:text-[#A1A09A] mt-1">
                        {{ number_format($totalApplied) }} Applied / {{ number_format($totalHired) }} Hired
                    </p>
                </div>
            </div>

            <!-- Card 2: Total Hired -->
            <div class="p-5 rounded-xl bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#3E3E3A] shadow-sm flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold uppercase tracking-wider text-[#706f6c] dark:text-[#A1A09A]">
                        Total Placed / Hired
                    </span>
                    <span class="p-2 rounded-lg bg-emerald-100 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </span>
                </div>
                <div class="mt-4">
                    <p class="text-3xl font-extrabold text-emerald-600 dark:text-emerald-400">
                        {{ number_format($totalHired) }}
                    </p>
                    <p class="text-xs text-[#706f6c] dark:text-[#A1A09A] mt-1">
                        Successful placements
                    </p>
                </div>
            </div>

            <!-- Card 3: Hiring Success Rate -->
            <div class="p-5 rounded-xl bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#3E3E3A] shadow-sm flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold uppercase tracking-wider text-[#706f6c] dark:text-[#A1A09A]">
                        Hiring Success Rate
                    </span>
                    <span class="p-2 rounded-lg bg-blue-100 dark:bg-blue-950/40 text-blue-600 dark:text-blue-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </span>
                </div>
                <div class="mt-4">
                    <p class="text-3xl font-extrabold text-blue-600 dark:text-blue-400">
                        {{ $hiringRate }}%
                    </p>
                    <p class="text-xs text-[#706f6c] dark:text-[#A1A09A] mt-1">
                        Conversion to hired
                    </p>
                </div>
            </div>

            <!-- Card 4: Top Applicant Barangay -->
            <div class="p-5 rounded-xl bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#3E3E3A] shadow-sm flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold uppercase tracking-wider text-[#706f6c] dark:text-[#A1A09A]">
                        Top Applicant Origin
                    </span>
                    <span class="p-2 rounded-lg bg-amber-100 dark:bg-amber-950/40 text-amber-600 dark:text-amber-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        </svg>
                    </span>
                </div>
                <div class="mt-4">
                    <p class="text-xl font-bold text-[#1b1b18] dark:text-[#EDEDEC] truncate" title="{{ $topOriginBarangay->barangay_name ?? 'N/A' }}">
                        {{ $topOriginBarangay->barangay_name ?? 'N/A' }}
                    </p>
                    <p class="text-xs text-[#706f6c] dark:text-[#A1A09A] mt-1">
                        {{ number_format($topOriginBarangay->app_count ?? 0) }} total applicants
                    </p>
                </div>
            </div>

        </div>

        <!-- Breakdown Details Card -->
        <div class="p-6 rounded-xl bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#3E3E3A] shadow-sm">
            <h2 class="text-base font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-4">
                Summary Overview
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div class="p-4 rounded-lg bg-[#f8fafc] dark:bg-[#1f1f1e] border border-[#e2e8f0] dark:border-[#2a2a28]">
                    <span class="text-xs text-[#706f6c] dark:text-[#A1A09A] font-semibold uppercase block mb-1">Most Active Job Location</span>
                    <p class="text-lg font-bold text-[#1b1b18] dark:text-[#EDEDEC]">
                        {{ $topJobBarangay->barangay ?? 'N/A' }}
                    </p>
                    <p class="text-xs text-[#706f6c] dark:text-[#A1A09A] mt-1">
                        {{ number_format($topJobBarangay->app_count ?? 0) }} applications received for jobs in this area.
                    </p>
                </div>

                <div class="p-4 rounded-lg bg-[#f8fafc] dark:bg-[#1f1f1e] border border-[#e2e8f0] dark:border-[#2a2a28]">
                    <span class="text-xs text-[#706f6c] dark:text-[#A1A09A] font-semibold uppercase block mb-1">Placement Conversion</span>
                    <p class="text-lg font-bold text-emerald-600 dark:text-emerald-400">
                        {{ $totalHired }} out of {{ $totalApplications }}
                    </p>
                    <p class="text-xs text-[#706f6c] dark:text-[#A1A09A] mt-1">
                        Overall placement ratio achieved on the platform.
                    </p>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
