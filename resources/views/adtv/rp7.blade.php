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
                <h1 class="text-2xl font-bold">Migration & Mobility Analysis</h1>
                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Cross-matching applicant residence vs job placement location.</p>
            </div>

        </div>

        <!-- Metric Summary -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div class="p-5 rounded-xl bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#3E3E3A] shadow-sm">
                <span class="text-xs font-semibold uppercase text-emerald-600 dark:text-emerald-400">Intra-Barangay Hires</span>
                <p class="text-3xl font-extrabold mt-2">{{ number_format($intraBarangayHires) }}</p>
                <p class="text-xs text-[#706f6c] dark:text-[#A1A09A] mt-1">Applicants hired within their home barangay</p>
            </div>
            <div class="p-5 rounded-xl bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#3E3E3A] shadow-sm">
                <span class="text-xs font-semibold uppercase text-blue-600 dark:text-blue-400">Inter-Barangay Hires</span>
                <p class="text-3xl font-extrabold mt-2">{{ number_format($interBarangayHires) }}</p>
                <p class="text-xs text-[#706f6c] dark:text-[#A1A09A] mt-1">Applicants traveling/commuting to another barangay for work</p>
            </div>
        </div>

        <!-- Cross Matching Table -->
        <div class="bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#3E3E3A] rounded-xl overflow-hidden shadow-sm">
            <table class="w-full text-left text-sm">
                <thead class="bg-[#f8fafc] dark:bg-[#1f1f1e] text-xs font-semibold uppercase text-[#706f6c] dark:text-[#A1A09A]">
                    <tr>
                        <th class="py-3 px-4">Residence Barangay</th>
                        <th class="py-3 px-4">Job Location Barangay</th>
                        <th class="py-3 px-4 text-center">Type</th>
                        <th class="py-3 px-4 text-center">Applications</th>
                        <th class="py-3 px-4 text-center">Hired</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#e2e8f0] dark:divide-[#2a2a28]">
                    @forelse ($mobilityStats as $row)
                        @php $isIntra = $row->residence_barangay === $row->work_barangay; @endphp
                        <tr class="hover:bg-[#f8fafc] dark:hover:bg-[#1f1f1e] transition-colors">
                            <td class="py-3 px-4 font-medium">{{ $row->residence_barangay }}</td>
                            <td class="py-3 px-4">{{ $row->work_barangay ?? 'N/A' }}</td>
                            <td class="py-3 px-4 text-center">
                                <span class="px-2 py-0.5 text-[10px] font-semibold rounded-full {{ $isIntra ? 'bg-emerald-100 text-emerald-600 dark:bg-emerald-950/50 dark:text-emerald-400' : 'bg-blue-100 text-blue-600 dark:bg-blue-950/50 dark:text-blue-400' }}">
                                    {{ $isIntra ? 'Local / Intra' : 'Commuter / Inter' }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-center">{{ number_format($row->total_applied) }}</td>
                            <td class="py-3 px-4 text-center font-bold text-emerald-600 dark:text-emerald-400">{{ number_format($row->total_hired) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="py-6 text-center text-[#706f6c]">No mobility data available.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
