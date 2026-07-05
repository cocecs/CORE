<x-app-layout>
    <!-- Chart.js Dependency (Injected inside the layout) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8 border-b border-gray-200 pb-5">
            <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Demographic Analytics</h2>
            <p class="text-sm text-gray-500 mt-1">Real-time overview of population distributions.</p>
        </div>

        <!-- Grid Row 1: Pie and Bar Charts (Gender & Age) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Gender Breakdown (Pie Chart) -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 flex flex-col justify-between">
                <h3 class="text-base font-semibold text-gray-700 mb-4">Gender Distribution</h3>
                <div class="relative h-64 flex justify-center">
                    <canvas id="genderChart"></canvas>
                </div>
            </div>

            <!-- Age Bracket (Bar Chart) -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 md:col-span-2">
                <h3 class="text-base font-semibold text-gray-700 mb-4">Age Brackets</h3>
                <div class="relative h-64">
                    <canvas id="ageChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Grid Row 2: Line and Horizontal Bar Charts (Location & Education) -->
        <div class="grid grid-cols-1 gap-6 mb-12">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                <h3 class="text-base font-semibold text-gray-700 mb-4">Registrations by Barangay</h3>
                <div class="relative h-64">
                    <canvas id="locationChart"></canvas>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                <h3 class="text-base font-semibold text-gray-700 mb-4">Educational Level / Course</h3>
                <div class="relative h-64">
                    <canvas id="educationChart"></canvas>
                </div>
            </div>
        </div>

        <!-- ==================================================================== -->
        <!-- NEW SECTION: Recruitment & Engagement Analytics                     -->
        <!-- ==================================================================== -->
        <div class="mb-8 border-b border-gray-200 pb-5 mt-12">
            <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Recruitment & Engagement</h2>
            <p class="text-sm text-gray-500 mt-1">Insights on market activity, user actions, and hiring pipelines.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Total Employers KPI Card -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 flex flex-col justify-center items-center text-center">
                <div class="p-3 bg-indigo-50 rounded-full mb-4 text-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <h3 class="text-base font-medium text-gray-500">Total Registered Employers</h3>
                <span class="text-5xl font-extrabold text-gray-900 mt-2 tracking-tight">
                    {{ $stats['total_employers'] ?? 0 }}
                </span>
                <p class="text-xs text-gray-400 mt-2">Active platforms partnering with PESO</p>
            </div>


            <!-- Job Lifecycle Analytics (Posted vs Saves vs Application) -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                <h3 class="text-base font-semibold text-gray-700 mb-4">Job Interaction Funnel</h3>
                <div class="relative h-64">
                    <canvas id="jobLifecycleChart"></canvas>
                </div>
            </div>

            <!-- Hiring Funnel Analytics (Interviewe vs Hired) -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                <h3 class="text-base font-semibold text-gray-700 mb-4">Interview vs. Placement Rate</h3>
                <div class="relative h-64">
                    <canvas id="hiringFunnelChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart JavaScript Injection -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // 1. Gender Chart (Pie)
            const ctxGender = document.getElementById('genderChart').getContext('2d');
            new Chart(ctxGender, {
                type: 'pie',
                data: {
                    labels: {!! json_encode(array_keys($stats['gender'] ?? ['Male' => 0, 'Female' => 0])) !!},
                    datasets: [{
                        data: {!! json_encode(array_values($stats['gender'] ?? [0, 0])) !!},
                        backgroundColor: ['#3b82f6', '#ec4899', '#10b981'],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { position: 'bottom' } }
                }
            });

            // 2. Age Bracket Chart (Vertical Bar)
            const ctxAge = document.getElementById('ageChart').getContext('2d');
            new Chart(ctxAge, {
                type: 'bar',
                data: {
                    labels: {!! json_encode(array_keys($stats['age_brackets'] ?? ['0-17' => 0, '18-30' => 0, '31-50' => 0, '51+' => 0])) !!},
                    datasets: [{
                        label: 'Count',
                        data: {!! json_encode(array_values($stats['age_brackets'] ?? [0, 0, 0, 0])) !!},
                        backgroundColor: '#6366f1',
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { y: { beginAtZero: true } }
                }
            });

            // 3. Location Chart (Line Graph)
            const ctxLocation = document.getElementById('locationChart').getContext('2d');
            new Chart(ctxLocation, {
                type: 'bar', // Changed from 'line' to 'bar'
                data: {
                    labels: {!! json_encode(array_keys($stats['locations'] ?? [])) !!},
                    datasets: [{
                        label: 'Residents',
                        data: {!! json_encode(array_values($stats['locations'] ?? [])) !!},
                        backgroundColor: 'rgba(6, 182, 212, 0.2)', // Semi-transparent teal fill
                        borderColor: '#06b6d4',                    // Solid teal border
                        borderWidth: 1,
                        borderRadius: 6                            // Optional: Gives bars modern rounded corners
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false // Optional: Hides the "Residents" legend box at the top for a cleaner look
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1 // Optional: Ensures the Y-axis increases in whole numbers (since residents are people)
                            }
                        }
                    }
                }
            });

            // 4. Educational Level Chart (Horizontal Bar)
            const ctxEducation = document.getElementById('educationChart').getContext('2d');
            new Chart(ctxEducation, {
                type: 'bar',
                data: {
                    labels: {!! json_encode(array_keys($stats['education'] ?? [])) !!},
                    datasets: [{
                        label: 'Count',
                        data: {!! json_encode(array_values($stats['education'] ?? [])) !!},
                        backgroundColor: '#f59e0b', // Amber
                        borderRadius: 6
                    }]
                },
                options: {
                    indexAxis: 'y', // This flips the chart to be horizontal
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false // Cleans up UI by hiding the 'Count' square at the top
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true, // Counts grow left-to-right on X axis
                            ticks: {
                                stepSize: 1 // Keeps increments to whole numbers
                            }
                        }
                    }
                }
            });

            // 5. Job Lifecycle Chart (Grouped Vertical Bar Chart)
            const ctxLifecycle = document.getElementById('jobLifecycleChart').getContext('2d');
            new Chart(ctxLifecycle, {
                type: 'bar',
                data: {
                    // Defines the single column category name on the bottom X-Axis
                    labels: ['Total Metrics'],
                    datasets: [
                        {
                            label: 'Posted',
                            data: [{{ $stats['total_jobpostings'] ?? 0 }}],
                            backgroundColor: '#3b82f6', // Blue
                            borderRadius: 4
                        },
                        {
                            label: 'Saved',
                            data: [{{ $stats['total_jobsaves'] ?? 0 }}],
                            backgroundColor: '#f59e0b', // Amber
                            borderRadius: 4
                        },
                        {
                            label: 'Applications',
                            data: [{{ $stats['total_jobapplications'] ?? 0 }}],
                            backgroundColor: '#10b981', // Emerald Green
                            borderRadius: 4
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // 6. Hiring Funnel Chart (Grouped Comparison Bar Chart)
            const ctxHiring = document.getElementById('hiringFunnelChart').getContext('2d');
            new Chart(ctxHiring, {
                type: 'bar',
                data: {
                    // Defines the single column category name on the bottom X-Axis
                    labels: ['Total Metrics'],
                    datasets: [
                        {
                            label: 'Interviewee',
                            data: [{{ $stats['interviewees'] ?? 0 }}],
                            backgroundColor: '#3b82f6', // Blue
                            borderRadius: 4
                        },
                        {
                            label: 'Hired',
                            data: [{{ $stats['hired'] ?? 0 }}],
                            backgroundColor: '#ec4899', // Pink
                            borderRadius: 4
                        },
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { y: { beginAtZero: true } },
                    plugins: { legend: { position: 'bottom' } }
                }
            });
        });
    </script>
</x-app-layout>
