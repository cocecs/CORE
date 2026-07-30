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
                <h1 class="text-2xl font-bold">Interactive Analytics & Charts</h1>
                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Visual breakdown of application statuses and barangay trends.</p>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- Donut Chart: Application Statuses -->
            <div class="bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#3E3E3A] rounded-xl p-6 shadow-sm flex flex-col items-center">
                <h2 class="text-sm font-bold uppercase tracking-wider text-[#706f6c] dark:text-[#A1A09A] mb-4">Application Status Ratio</h2>
                <div class="w-full max-w-xs">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>

            <!-- Bar Chart: Top Barangays -->
            <div class="bg-white dark:bg-[#161615] border border-[#19140015] dark:border-[#3E3E3A] rounded-xl p-6 shadow-sm">
                <h2 class="text-sm font-bold uppercase tracking-wider text-[#706f6c] dark:text-[#A1A09A] mb-4">Top 5 Applicant Barangays</h2>
                <div class="w-full">
                    <canvas id="barangayChart"></canvas>
                </div>
            </div>

        </div>
    </div>
<!-- Add Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
document.addEventListener("DOMContentLoaded", function () {
    // Data passed from Laravel Controller
    const statusData = @json($statusCounts);
    const barangayData = @json($topBarangays);

    // Safeguard: Check if Chart library exists
    if (typeof Chart === 'undefined') {
        console.error('Chart.js library is not loaded!');
        return;
    }

    // 1. Render Status Donut Chart
    const statusCtx = document.getElementById('statusChart');
    if (statusCtx) {
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: Object.keys(statusData),
                datasets: [{
                    data: Object.values(statusData),
                    backgroundColor: ['#f59e0b', '#10b981', '#3b82f6', '#ef4444', '#6b7280']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }

    // 2. Render Top Barangay Bar Chart
    const barangayCtx = document.getElementById('barangayChart');
    if (barangayCtx) {
        new Chart(barangayCtx, {
            type: 'bar',
            data: {
                labels: barangayData.map(item => item.name ?? 'Unspecified'),
                datasets: [{
                    label: 'Total Applications',
                    data: barangayData.map(item => item.total),
                    backgroundColor: '#f97316'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    }
});
</script>
</x-app-layout>
