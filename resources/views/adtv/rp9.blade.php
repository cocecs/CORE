<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold leading-tight text-gray-800">
            {{ __('List of Posted Jobs') }}
        </h2>
    </x-slot>

@csrf
<div class="max-w-6xl mx-auto space-y-8">

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-[#e2e8f0] dark:border-[#2a2a28] pb-5">
            <div>
                <h1 class="text-2xl font-bold">Job Sector & Skill Demand</h1>
                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Breakdown of posted job categories and application volumes.</p>
            </div>
            
        </div>

        <div class="bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#3E3E3A] rounded-xl overflow-hidden shadow-sm">
            <table class="w-full text-left text-sm">
                <thead class="bg-[#f8fafc] dark:bg-[#1f1f1e] text-xs font-semibold uppercase text-[#706f6c] dark:text-[#A1A09A]">
                    <tr>
                        <th class="py-3 px-4">Industry / Sector</th>
                        <th class="py-3 px-4 text-center">Job Postings</th>
                        <th class="py-3 px-4 text-center">Applications Received</th>
                        <th class="py-3 px-4 text-center">Placements (Hired)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#e2e8f0] dark:divide-[#2a2a28]">
                    @forelse ($sectorStats as $row)
                        <tr class="hover:bg-[#f8fafc] dark:hover:bg-[#1f1f1e] transition-colors">
                            <td class="py-3 px-4 font-semibold">{{ $row->sector }}</td>
                            <td class="py-3 px-4 text-center font-medium">{{ number_format($row->total_job_postings) }}</td>
                            <td class="py-3 px-4 text-center">{{ number_format($row->total_applications) }}</td>
                            <td class="py-3 px-4 text-center font-bold text-emerald-600 dark:text-emerald-400">{{ number_format($row->total_hired) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="py-6 text-center text-[#706f6c]">No sector data available.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
