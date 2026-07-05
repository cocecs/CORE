<x-app-layout>
<div class="max-w-2xl mx-auto bg-white p-6 shadow-sm rounded-xl border border-gray-200">
    <!-- Header Title (Partially cropped in image_45a4ad.png but inferred) -->
    <h2 class="text-xl font-bold text-gray-800 mb-4">A. General Analysis Based on the LMI Report</h2>

    <!-- LMI Data Table -->
    <div class="overflow-hidden border border-gray-700 rounded-sm mb-4">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-blue-200 border-b border-gray-700">
                    <th colspan="2" class="py-2 text-center font-semibold text-gray-800 tracking-wide text-lg">
                        LMI Data
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700 text-gray-900 font-medium">
                <tr>
                    <td class="p-2 pl-4">No. of Vacancies Solicited</td>
                    <td class="p-2 text-center border-l border-gray-700 w-32">{{ $vacanciesSolicited ?? 100 }}</td>
                </tr>
                <tr>
                    <td class="p-2 pl-4">No. of Applicants Registered</td>
                    <td class="p-2 text-center border-l border-gray-700 w-32">{{ $applicantsRegistered ?? 51 }}</td>
                </tr>
                <tr>
                    <td class="p-2 pl-4">No. of Applicants Referred</td>
                    <td class="p-2 text-center border-l border-gray-700 w-32">{{ $applicantsReferred ?? 51 }}</td>
                </tr>
                <tr>
                    <td class="p-2 pl-4">No. of Applicants Placed</td>
                    <td class="p-2 text-center border-l border-gray-700 w-32">{{ $applicantsPlaced ?? 51 }}</td>
                </tr>
                <tr class="font-bold bg-gray-50">
                    <td class="p-2 pl-4 text-base">Placement Rate</td>
                    <td class="p-2 text-center border-l border-gray-700 text-base w-32">
                        {{ number_format($placementRate ?? 100.00, 2) }}%
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Interpretation Section -->
    <div class="mt-6">
        <h3 class="text-lg font-bold text-gray-900 mb-2">Interpretation</h3>
        <div class="border border-gray-700 p-6 text-center text-gray-800 text-lg leading-relaxed rounded-sm">
            <p>
                Of the <span class="font-semibold">{{ $vacanciesSolicited ?? 100 }}</span> job vacancies solicited,
                <span class="font-semibold">{{ $applicantsRegistered ?? 51 }}</span> applicants registered for the said vacancies.
                And of the <span class="font-semibold">{{ $applicantsReferred ?? 51 }}</span> applicants referred for employment,
                <span class="font-semibold">{{ $applicantsPlaced ?? 51 }}</span> were placed.
                The placement rate is <span class="font-semibold">{{ number_format($placementRate ?? 100.00, 2) }}%</span>
            </p>
        </div>
    </div>
</div>
<div class="max-w-2xl mx-auto bg-white p-6 shadow-sm rounded-xl border border-gray-200 mt-6">
    <h2 class="text-xl font-bold text-gray-800 mb-6">LMI Graphical Presentation for JANUARY 2026</h2>

    <div class="relative w-full h-80">
        <canvas id="lmiMonthlyChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('lmiMonthlyChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    ['No. of Vacancies', 'Solicited'],
                    ['No. of Applicants', 'Registered'],
                    ['No. of Applicants', 'Referred'],
                    ['No. of Applicants', 'Placed']
                ],
                datasets: [{
                    data: [
                        {{ $vacanciesSolicited ?? 100 }},
                        {{ $applicantsRegistered ?? 51 }},
                        {{ $applicantsReferred ?? 51 }},
                        {{ $applicantsPlaced ?? 51 }}
                    ],
                    backgroundColor: '#f97316', // Tailwind orange-500 matching the image
                    borderRadius: 4,
                    barThickness: 45
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false // No legend needed as titles are on the X-axis
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 120,
                        ticks: {
                            stepSize: 20,
                            color: '#4b5563', // gray-600
                            font: {
                                size: 13
                            }
                        },
                        grid: {
                            color: '#e5e7eb' // light gray gridlines
                        }
                    },
                    x: {
                        ticks: {
                            color: '#374151', // gray-700
                            font: {
                                size: 12,
                                weight: '500'
                            }
                        },
                        grid: {
                            display: false // Removes vertical lines to match the image layout
                        }
                    }
                }
            }
        });
    });
</script>

<div class="max-w-7xl mx-auto bg-white p-6 shadow-sm rounded-xl border border-gray-200">
    <h2 class="text-xl font-bold text-gray-800 mb-4">B. Detailed Analysis Based on the SPRS Monthly Report</h2>

    <div class="overflow-x-auto border border-gray-700 rounded-sm mb-6">
        <table class="w-full text-center border-collapse text-xs md:text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-700 font-medium text-gray-900">
                    <th colspan="2" class="p-2 border-r border-gray-700 w-1/4">Total No of Jobs Solicited</th>
                    <th colspan="2" class="p-2 border-r border-gray-700 w-1/4">Total No. of Applicants Registered</th>
                    <th colspan="2" class="p-2 border-r border-gray-700 w-1/4">Total No. of Applicants Referred</th>
                    <th colspan="2" class="p-2 w-1/4">Total No. of Applicants Placed</th>
                </tr>
                <tr class="bg-gray-50 border-b border-gray-700 text-gray-700">
                    <th class="p-1 border-r border-gray-700 font-normal">Local</th>
                    <th class="p-1 border-r border-gray-700 font-normal">Overseas</th>
                    <th class="p-1 border-r border-gray-700 font-normal">Male</th>
                    <th class="p-1 border-r border-gray-700 font-normal">Female</th>
                    <th class="p-1 border-r border-gray-700 font-normal">Male</th>
                    <th class="p-1 border-r border-gray-700 font-normal">Female</th>
                    <th class="p-1 border-r border-gray-700 font-normal">Male</th>
                    <th class="p-1 font-normal">Female</th>
                </tr>
            </thead>
            <tbody class="text-gray-900 font-semibold text-base">
                <tr>
                    <td class="p-2 border-r border-gray-700">{{ $jobsLocal ?? 100 }}</td>
                    <td class="p-2 border-r border-gray-700">{{ $jobsOverseas ?? 0 }}</td>
                    <td class="p-2 border-r border-gray-700">{{ $registeredMale ?? 25 }}</td>
                    <td class="p-2 border-r border-gray-700">{{ $registeredFemale ?? 26 }}</td>
                    <td class="p-2 border-r border-gray-700">{{ $referredMale ?? 25 }}</td>
                    <td class="p-2 border-r border-gray-700">{{ $referredFemale ?? 26 }}</td>
                    <td class="p-2 border-r border-gray-700">{{ $placedMale ?? 25 }}</td>
                    <td class="p-2">{{ $placedFemale ?? 26 }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="flex flex-wrap items-baseline gap-2 mb-4 text-sm md:text-base border-b pb-2">
        <span class="font-bold text-gray-900">Graphical Presentation of LMI Based on Monthly SPRS Report for</span>
        <span class="font-black text-gray-900 tracking-wider uppercase bg-gray-100 px-2 py-0.5 rounded">{{ $reportMonth ?? 'JANUARY 2026' }}</span>
        <span class="text-gray-500 text-xs">according to:</span>
    </div>

    <!-- Main responsive outer wrapper -->
    <div class="w-full overflow-x-auto pb-4">
        <!-- Forced horizontal layout row -->
        <div class="flex flex-row gap-4 min-w-[950px] w-full">

            <!-- Chart 1: Type of Vacancy -->
            <div class="flex-1 min-w-[220px] border border-gray-200 rounded p-4 bg-white flex flex-col items-center">
                <h4 class="text-xs font-bold text-gray-800 uppercase mb-4 text-center h-8 flex items-center justify-center">Type of Vacancy</h4>
                <div class="relative w-full h-40">
                    <canvas id="vacancyTypeChart"></canvas>
                </div>
            </div>

            <!-- Chart 2: Registered by Sex -->
            <div class="flex-1 min-w-[220px] border border-gray-200 rounded p-4 bg-white flex flex-col items-center">
                <h4 class="text-xs font-bold text-gray-800 uppercase mb-4 text-center h-8 flex items-center justify-center">Applicants Registered<br>by Sex</h4>
                <div class="relative w-full h-40">
                    <canvas id="registeredSexChart"></canvas>
                </div>
            </div>
        </div>
        <div class="flex flex-row gap-4 min-w-[950px] w-full">

            <!-- Chart 3: Referred by Sex -->
            <div class="flex-1 min-w-[220px] border border-gray-200 rounded p-4 bg-white flex flex-col items-center">
                <h4 class="text-xs font-bold text-gray-800 uppercase mb-4 text-center h-8 flex items-center justify-center">Applicants Referred<br>by Sex</h4>
                <div class="relative w-full h-40">
                    <canvas id="referredSexChart"></canvas>
                </div>
            </div>

            <!-- Chart 4: Placed by Sex -->
            <div class="flex-1 min-w-[220px] border border-gray-200 rounded p-4 bg-white flex flex-col items-center">
                <h4 class="text-xs font-bold text-gray-800 uppercase mb-4 text-center h-8 flex items-center justify-center">Applicants Placed<br>by Sex</h4>
                <div class="relative w-full h-40">
                    <canvas id="placedSexChart"></canvas>
                </div>
            </div>

        </div>
    </div>

    <div class="border border-gray-700 p-4 rounded-sm bg-white">
        <h3 class="text-sm font-bold text-gray-900 mb-2">Interpretation</h3>
        <p class="text-gray-800 text-sm leading-relaxed text-center">
            The above data shows that majority of the job vacancies solicited for the month of
            <span class="font-semibold">{{ $reportMonth ?? 'January 2026' }}</span> is local at
            <span class="font-semibold">{{ $localJobPercentage ?? '100' }}%</span>.
            As to sex disaggregation, majority of the applicants registered were male
            (<span class="font-semibold">{{ $registeredMalePercentage ?? '51' }}%</span>),
            majority of the applicants referred were male
            (<span class="font-semibold">{{ $referredMalePercentage ?? '51' }}%</span>),
            and majority of the applicants placed were male
            (<span class="font-semibold">{{ $placedMalePercentage ?? '51' }}%</span>).
        </p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const globalOptions = {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%', // Controls the inner circle size to turn pie into a thin doughnut ring
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { boxWidth: 10, padding: 10, font: { size: 11 } }
                }
            }
        };

        // Chart 1: Vacancy Types (Local vs Overseas)
        new Chart(document.getElementById('vacancyTypeChart'), {
            type: 'doughnut',
            data: {
                labels: ['Local', 'Overseas'],
                datasets: [{
                    data: [{{ $jobsLocal ?? 100 }}, {{ $jobsOverseas ?? 0 }}],
                    backgroundColor: ['#60a5fa', '#cbd5e1'] // blue-400 / slate-300
                }]
            },
            options: globalOptions
        });

        // Chart 2: Registered Sex
        new Chart(document.getElementById('registeredSexChart'), {
            type: 'doughnut',
            data: {
                labels: ['Male', 'Female'],
                datasets: [{
                    data: [{{ $registeredMale ?? 25 }}, {{ $registeredFemale ?? 26 }}],
                    backgroundColor: ['#4ade80', '#60a5fa'] // green-400 / blue-400
                }]
            },
            options: globalOptions
        });

        // Chart 3: Referred Sex
        new Chart(document.getElementById('referredSexChart'), {
            type: 'doughnut',
            data: {
                labels: ['Male', 'Female'],
                datasets: [{
                    data: [{{ $referredMale ?? 25 }}, {{ $referredFemale ?? 26 }}],
                    backgroundColor: ['#f97316', '#facc15'] // orange-500 / yellow-400
                }]
            },
            options: globalOptions
        });

        // Chart 4: Placed Sex
        new Chart(document.getElementById('placedSexChart'), {
            type: 'doughnut',
            data: {
                labels: ['Male', 'Female'],
                datasets: [{
                    data: [{{ $placedMale ?? 25 }}, {{ $placedFemale ?? 26 }}],
                    backgroundColor: ['#60a5fa', '#f97316'] // blue-400 / orange-500
                }]
            },
            options: globalOptions
        });
    });
</script>
<div class="max-w-5xl mx-auto bg-white p-6 shadow-sm rounded-xl border border-gray-200 mt-6">
    <h2 class="text-xl font-bold text-gray-800 mb-4">C. Comparative monthly performance between current and previous year</h2>

    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-start">

        <div class="md:col-span-7 overflow-hidden border border-gray-700 rounded-sm">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-blue-200 border-b border-gray-700">
                        <th class="p-2 pl-4 font-semibold text-gray-800 text-base">LMI Data</th>
                        <th class="p-2 text-center border-l border-gray-700 text-base w-24 bg-blue-200">2025</th>
                        <th class="p-2 text-center border-l border-gray-700 text-base w-24 bg-blue-200">2024</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700 text-gray-900 font-medium">
                    <tr>
                        <td class="p-2 pl-4">No. of Vacancies Solicited</td>
                        <td class="p-2 text-center border-l border-gray-700">{{ $currentVacancies ?? 100 }}</td>
                        <td class="p-2 text-center border-l border-gray-700">{{ $previousVacancies ?? 80 }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 pl-4">No. of Applicants Registered</td>
                        <td class="p-2 text-center border-l border-gray-700">{{ $currentRegistered ?? 51 }}</td>
                        <td class="p-2 text-center border-l border-gray-700">{{ $previousRegistered ?? 20 }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 pl-4">No. of Applicants Referred</td>
                        <td class="p-2 text-center border-l border-gray-700">{{ $currentReferred ?? 51 }}</td>
                        <td class="p-2 text-center border-l border-gray-700">{{ $previousReferred ?? 20 }}</td>
                    </tr>
                    <tr>
                        <td class="p-2 pl-4">No. of Applicants Placed</td>
                        <td class="p-2 text-center border-l border-gray-700">{{ $currentPlaced ?? 51 }}</td>
                        <td class="p-2 text-center border-l border-gray-700">{{ $previousPlaced ?? 20 }}</td>
                    </tr>
                    <tr class="font-bold bg-gray-50">
                        <td class="p-2 pl-4 text-base">Placement Rate</td>
                        <td class="p-2 text-center border-l border-gray-700 text-base">
                            {{ number_format($currentPlacementRate ?? 100.00, 2) }}%
                        </td>
                        <td class="p-2 text-center border-l border-gray-700 text-base">
                            {{ number_format($previousPlacementRate ?? 100.00, 2) }}%
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="md:col-span-5 h-full">
            <div class="border border-gray-700 p-4 text-gray-800 text-sm md:text-base leading-relaxed rounded-sm h-full flex items-center bg-white">
                <p>
                    Based on the herein comparative data, the placement rate for
                    <strong>PESO Tangub</strong> for the month of January 2026 is
                    <span class="font-semibold">{{ number_format($currentPlacementRate ?? 100.00, 1) }}%</span>
                    the same as compared to year 2024. Most of the placement are by the LGU.
                </p>
            </div>
        </div>

    </div>
</div>
</x-app-layout>
