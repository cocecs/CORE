<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold leading-tight text-gray-800">
            {{ __('List of Posted Jobs') }}
        </h2>
    </x-slot>

@csrf
<!-- Added w-full and max-w-5xl to the table wrapper -->
<div class="max-w-6xl mx-auto space-y-8">

        <!-- Page Title Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-[#e2e8f0] dark:border-[#2a2a28] pb-5">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">
                    Barangay Served Report
                </h1>
                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mt-1">
                    Summary of application counts grouped by job locations and applicant home barangays.
                </p>
            </div>

            <button onclick="window.print()" class="self-start sm:self-auto px-4 py-2 bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white text-xs font-semibold rounded-lg shadow transition duration-200">
                Print Report
            </button>
        </div>

        <!-- Summary Metric Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            <div class="p-5 rounded-xl bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#3E3E3A] shadow-sm">
                <span class="text-xs font-medium text-[#706f6c] dark:text-[#A1A09A]">Total Applications</span>
                <p class="text-2xl lg:text-3xl font-bold text-orange-500 mt-1">{{ number_format($totalApplications) }}</p>
            </div>

            <div class="p-5 rounded-xl bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#3E3E3A] shadow-sm">
                <span class="text-xs font-medium text-[#706f6c] dark:text-[#A1A09A]">Job Work Locations Served (Barangays)</span>
                <p class="text-2xl lg:text-3xl font-bold text-amber-500 mt-1">{{ number_format($totalJobBarangaysServed) }}</p>
            </div>

            <div class="p-5 rounded-xl bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#3E3E3A] shadow-sm sm:col-span-2 lg:col-span-1">
                <span class="text-xs font-medium text-[#706f6c] dark:text-[#A1A09A]">Applicant Locations Served (Barangays)</span>
                <p class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC] mt-2">{{ number_format($hiredBarangaysCount) }}</p>
            </div>
        </div>

        <!-- Section 1: Work Location (job_postings) -->
        <div class="bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#3E3E3A] rounded-xl p-6 shadow-sm">
            <h2 class="text-lg font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-1">
                Applications by Work Location
            </h2>
            <p class="text-xs text-[#706f6c] dark:text-[#A1A09A] mb-4">
                Based on job work locations.
            </p>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-[#e2e8f0] dark:border-[#2a2a28] text-xs font-semibold text-[#706f6c] dark:text-[#A1A09A] uppercase">
                            <th class="py-3 px-4">Province</th>
                            <th class="py-3 px-4">Town / City</th>
                            <th class="py-3 px-4">Barangay</th>
                            <th class="py-3 px-4 text-right">Application Count</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#e2e8f0] dark:divide-[#2a2a28]">
                        @forelse ($jobBarangayStats as $row)
                            <tr class="hover:bg-[#f8fafc] dark:hover:bg-[#1f1f1e] transition-colors">
                                <td class="py-3 px-4">{{ $row->province }}</td>
                                <td class="py-3 px-4">{{ $row->town }}</td>
                                <td class="py-3 px-4 font-medium text-[#1b1b18] dark:text-[#EDEDEC]">
                                    {{ $row->barangay }}
                                </td>
                                <td class="py-3 px-4 text-right">
                                    <span class="inline-block px-3 py-1 bg-orange-100 dark:bg-orange-950/50 text-orange-600 dark:text-orange-400 font-semibold rounded-full text-xs">
                                        {{ $row->total_applications }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-6 text-center text-[#706f6c] dark:text-[#A1A09A]">
                                    No application data available.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Section 2: Applicant Origin (user_details) -->
        <div class="bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#3E3E3A] rounded-xl p-6 shadow-sm">
            <h2 class="text-lg font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-1">
                Applications by Applicant Residence
            </h2>
            <p class="text-xs text-[#706f6c] dark:text-[#A1A09A] mb-4">
                Based on applicant registered addresses.
            </p>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-[#e2e8f0] dark:border-[#2a2a28] text-xs font-semibold text-[#706f6c] dark:text-[#A1A09A] uppercase">
                            <th class="py-3 px-4">Province</th>
                            <th class="py-3 px-4">Town / City</th>
                            <th class="py-3 px-4">Barangay</th>
                            <th class="py-3 px-4 text-center">Applied</th>
                            <th class="py-3 px-4 text-center">Hired</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#e2e8f0] dark:divide-[#2a2a28]">
                        @forelse ($applicantBarangayStats as $row)
                            <tr class="hover:bg-[#f8fafc] dark:hover:bg-[#1f1f1e] transition-colors">
                                <td class="py-3 px-4">{{ $row->province }}</td>
                                <td class="py-3 px-4">{{ $row->town_name }}</td>
                                <td class="py-3 px-4 font-medium text-[#1b1b18] dark:text-[#EDEDEC]">
                                    {{ $row->barangay_name }}
                                </td>
                                <td class="py-3 px-4 text-right">
                                    <span class="inline-block px-3 py-1 bg-amber-100 dark:bg-amber-950/50 text-amber-600 dark:text-amber-400 font-semibold rounded-full text-xs">
                                        {{ $row->total_applications }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-6 text-center text-[#706f6c] dark:text-[#A1A09A]">
                                    No applicant residence data available.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</x-app-layout>
