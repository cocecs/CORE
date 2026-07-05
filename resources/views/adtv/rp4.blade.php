<x-app-layout>
<div class="w-full bg-white p-6 shadow-sm border border-gray-200 overflow-x-auto">
    <div class="mb-4 text-xs font-mono tracking-wider text-gray-700 uppercase">
        NAME OF PESO: {{ $pesoName ?? 'VICTORIA S. BERIOSO' }}
    </div>

    <div class="text-center mb-6">
        <h2 class="text-xl font-bold text-gray-900 tracking-wide uppercase">APPLICANT PLACED</h2>
        <h3 class="text-sm font-semibold text-gray-700">For the month of {{ $reportMonth ?? 'January 2026' }}</h3>
    </div>

    <div class="overflow-x-auto border border-gray-400">
        <table class="min-w-full text-left border-collapse bg-white text-xs font-sans">
            <thead>
                <tr class="border-b border-gray-400 text-gray-800 uppercase font-semibold">
                    <th class="p-3 border-r border-gray-400 text-center w-16">NO.</th>
                    <th class="p-3 border-r border-gray-400 min-w-[250px] text-center">NAME OF APPLICANT</th>
                    <th class="p-3 border-r border-gray-400 min-w-[250px] text-center">PLACED/HIRED AS (OCCUPATION)</th>
                    <th class="p-3 text-center w-32">SEX</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-300 text-gray-900 tracking-tight">
                @forelse($placedApplicants as $index => $applicant)
                    <tr class="hover:bg-gray-50/70">
                        <td class="p-2 border-r border-gray-300 text-center font-medium text-gray-600">
                            {{ $index + 1 }}
                        </td>

                        <td class="p-2 border-r border-gray-300 uppercase font-medium pl-4">
                            {{ $applicant->name }}
                        </td>

                        <td class="p-2 border-r border-gray-300 uppercase text-gray-700 pl-4">
                            {{ $applicant->placed_as }}
                        </td>

                        <td class="p-2 text-center text-gray-700">
                            {{ $applicant->sex }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-12 text-center text-gray-400 font-medium tracking-wide bg-gray-50/30">
                            No placements recorded for this processing period.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</x-app-layout>
