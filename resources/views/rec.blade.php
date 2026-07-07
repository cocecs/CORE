<x-app-layout>

<div class="container mx-auto px-4 py-8">
    <!-- Header with Toggle Button -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Job Recommendations For You</h1>
            <p class="text-sm text-gray-600">
                Showing active jobs matching your preferences within a <span class="font-semibold text-blue-600">{{ $maxDistanceKm }}km</span> radius.
            </p>
        </div>

        <!-- Toggle Button to Open Modal -->
        <button id="open-filter-btn" type="button" class="inline-flex items-center justify-center gap-2 bg-indigo-600 text-white py-2.5 px-5 rounded-xl hover:bg-indigo-700 font-semibold text-sm shadow-sm transition duration-150 self-start sm:self-center">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
            </svg>
            Search & Filter Jobs
            @if(request()->hasAny(['job_type', 'job_category', 'province', 'town']))
                <span class="ml-1 px-1.5 py-0.5 text-xs bg-indigo-800 rounded-full">Active</span>
            @endif
        </button>
    </div>

    <!-- Backdrop Modal (Hidden by default using 'hidden') -->
    <div id="filter-modal" class="fixed inset-0 z-50 hidden bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center p-4 transition-opacity">

        <!-- Modal Card Structure -->
        <div class="w-full max-w-xl rounded-xl bg-white p-6 text-gray-600 shadow-xl relative animate-fade-in-up">

            <!-- Modal Header -->
            <div class="flex items-center justify-between border-b border-gray-100 pb-3 mb-4">
                <h3 class="text-lg font-bold text-gray-800">Advanced Job Search</h3>
                <button id="close-filter-btn" type="button" class="text-gray-400 hover:text-gray-600 p-1 rounded-lg hover:bg-gray-100 transition">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Filter Form -->
            <form action="{{ request()->url() }}" method="GET">
                @foreach(request()->except(['job_type', 'job_category', 'province', 'town']) as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach

                <!-- Stacked Criteria Fields -->
                <div class="space-y-4 mb-6">
                    <div>
                        <label for="job_type" class="block text-sm font-medium text-gray-700 mb-1">Type of Job <span class="text-red-700">*</span></label>
                        <select id="job_type" name="job_type" class="block w-full text-sm rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value=""></option>
                            <option value="Full Time" {{ request('job_type') == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                            <option value="Part Time" {{ request('job_type') == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                            <option value="Contract / Freelance" {{ request('job_type') == 'Contract / Freelance' ? 'selected' : '' }}>Contract / Freelance</option>
                            <option value="Temporary / Seasonal" {{ request('job_type') == 'Temporary / Seasonal' ? 'selected' : '' }}>Temporary / Seasonal</option>
                        </select>
                    </div>

                    <div>
                        <label for="job_category" class="block text-sm font-medium text-gray-700 mb-1">Category of Job <span class="text-red-700">*</span></label>
                        <select id="job_category" name="job_category" class="block w-full text-sm rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value=""></option>
                            @foreach($expertise as $item)
                                <option value="{{ $item->id }}" {{ request('job_category') == $item->id ? 'selected' : '' }}>{{ $item->area_of_expertise }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Work Location Section -->
                    <div class="pt-2 border-t border-gray-100">
                        <h4 class="text-sm font-semibold text-gray-800 mb-3">Preferred Work Location</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="province" class="block text-xs font-medium text-gray-500 mb-1">Province</label>
                                <select id="province" name="province" class="block w-full text-sm rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Select Province</option>
                                </select>
                            </div>

                            <div>
                                <label for="town" class="block text-xs font-medium text-gray-500 mb-1">Town / City</label>
                                <select id="town" name="town" class="block w-full text-sm rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" disabled>
                                    <option value="">Select Town/City</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="flex items-center justify-end gap-2 pt-4 border-t border-gray-100">
                    @if(request()->hasAny(['job_type', 'job_category', 'province', 'town']))
                        <a href="{{ request()->url() }}" class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-md transition">
                            Clear Filters
                        </a>
                    @endif
                    <button type="submit" class="bg-indigo-600 text-white py-2 px-5 rounded-md hover:bg-indigo-700 font-medium text-sm transition">
                        Filter Jobs
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Active Jobs Grid Container Layout -->
    @if($jobs->isEmpty())
        <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-4 rounded-lg">
            No jobs found nearby matching your specific criteria at the moment.
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($jobs as $job)
                <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">{{ $job->job_title }}</h2>
                            <p class="text-md text-gray-700 font-medium">{{ strtoupper($job->area_of_expertise) }}</p>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ round($job->distance, 1) }} km away
                        </span>
                    </div>

                    <div class="mt-4 flex flex-wrap gap-2 text-sm text-gray-500">
                        <div class="flex items-center">
                            <span class="font-medium text-gray-700">Type:</span>&nbsp;{{ $job->job_type }}
                        </div>
                        <span class="text-gray-300">•</span>
                        <div class="flex items-center">
                            <span class="font-medium text-gray-700">Location:</span>&nbsp;{{ $job->barangay }}, {{ $job->town }}, {{ $job->province }}
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t border-gray-100 flex justify-between items-center">
                        <span class="text-xs text-gray-400">Posted {{ $job->created_at->diffForHumans() }}</span>
                        <a href="/recd/{{ $job->job_id }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800">
                            View Job Details &rarr;
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Modal & Async API Script Block -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // --- Modal Management Logic ---
    const modal = document.getElementById('filter-modal');
    const openBtn = document.getElementById('open-filter-btn');
    const closeBtn = document.getElementById('close-filter-btn');

    const openModal = () => modal.classList.remove('hidden');
    const closeModal = () => modal.classList.add('hidden');

    openBtn.addEventListener('click', openModal);
    closeBtn.addEventListener('click', closeModal);

    modal.addEventListener('click', function(e) {
        if (e.target === modal) closeModal();
    });

    // --- Dynamic Location Filters Logic ---
    const provinceSelect = document.getElementById('province');
    const townSelect = document.getElementById('town');

    const provincesUrl = "{{ url('/api/provinces') }}";
    const townsUrl     = "{{ url('/api/towns') }}";

    // 1. Fetch Provinces
    fetch(provincesUrl)
        .then(res => res.json())
        .then(provinces => {
            provinces.forEach(province => {
                let opt = document.createElement('option');
                opt.value = province;
                opt.textContent = province;
                if(province === "{{ request('province') }}") opt.selected = true;
                provinceSelect.appendChild(opt);
            });
            if(provinceSelect.value) provinceSelect.dispatchEvent(new Event('change'));
        })
        .catch(err => console.error('Error fetching provinces:', err));

    // 2. When Province Changes
    provinceSelect.addEventListener('change', function () {
        const province = this.value;
        townSelect.innerHTML = '<option value="">Select Town/City</option>';
        townSelect.disabled = true;

        if (!province) return;

        fetch(`${townsUrl}?province=${encodeURIComponent(province)}`)
            .then(res => res.json())
            .then(towns => {
                towns.forEach(t => {
                    let opt = document.createElement('option');
                    opt.value = t.town;
                    opt.textContent = t.town;
                    if(t.id == "{{ request('town') }}") opt.selected = true;
                    townSelect.appendChild(opt);
                });
                townSelect.disabled = false;
            });
    });
});
</script>

</x-app-layout>
