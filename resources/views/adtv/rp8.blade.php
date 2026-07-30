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
                <h1 class="text-2xl font-bold">Demographic & Educational Breakdown</h1>
                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Applicant profile metrics by gender and education level.</p>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- Gender Table -->
            <div class="bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#3E3E3A] rounded-xl p-5 shadow-sm">
                <h2 class="text-base font-bold mb-4">By Gender</h2>
                <table class="w-full text-left text-sm">
                    <thead class="bg-[#f8fafc] dark:bg-[#1f1f1e] text-xs font-semibold uppercase text-[#706f6c] dark:text-[#A1A09A]">
                        <tr>
                            <th class="py-2 px-3">Sex</th>
                            <th class="py-2 px-3 text-center">Applications</th>
                            <th class="py-2 px-3 text-center">Hired</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#e2e8f0] dark:divide-[#2a2a28]">
                        @foreach ($genderStats as $row)
                            <tr>
                                <td class="py-2 px-3 font-medium capitalize">{{ $row->sex }}</td>
                                <td class="py-2 px-3 text-center">{{ number_format($row->total_applications) }}</td>
                                <td class="py-2 px-3 text-center font-bold text-emerald-600 dark:text-emerald-400">{{ number_format($row->total_hired) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Education Table -->
            <div class="bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#3E3E3A] rounded-xl p-5 shadow-sm">
                <h2 class="text-base font-bold mb-4">By Educational Attainment</h2>
                <table class="w-full text-left text-sm">
                    <thead class="bg-[#f8fafc] dark:bg-[#1f1f1e] text-xs font-semibold uppercase text-[#706f6c] dark:text-[#A1A09A]">
                        <tr>
                            <th class="py-2 px-3">Education Level</th>
                            <th class="py-2 px-3 text-center">Applications</th>
                            <th class="py-2 px-3 text-center">Hired</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#e2e8f0] dark:divide-[#2a2a28]">
                        @foreach ($educationStats as $row)
                            <tr>
                                <td class="py-2 px-3 font-medium">{{ $row->educ_attainment }}</td>
                                <td class="py-2 px-3 text-center">{{ number_format($row->total_applications) }}</td>
                                <td class="py-2 px-3 text-center font-bold text-emerald-600 dark:text-emerald-400">{{ number_format($row->total_hired) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
