{{-- <x-app-layout>

<div class="container mx-auto px-4 py-8">
    <!-- Header with Toggle Button -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            @if(request()->has('show_all'))
                <h1 class="text-2xl font-bold text-gray-800">All Job Vacancies</h1>
                <p class="text-sm text-gray-600">
                    Showing the complete list of all active vacancies with no search or profile filters applied.
            @else
                <h1 class="text-2xl font-bold text-gray-800">Job Recommendations For You</h1>
                <p class="text-sm text-gray-600">
                    Showing active jobs matched to your skills and sorted by proximity.
                </p>
            @endif
        </div>

        <!-- Filter Toggle and Reset Buttons -->
        <div class="flex items-center gap-2 self-start sm:self-center">
            @if(request()->has('show_all') || request()->hasAny(['job_type', 'job_category', 'province', 'town']))
                <a href="{{ route('recommended') }}" class="inline-flex items-center justify-center bg-gray-100 border border-gray-200 text-gray-700 py-2.5 px-4 rounded-xl hover:bg-gray-200 font-semibold text-sm transition duration-150 shadow-sm">
                    Reset View
                </a>
            @endif

            <button id="open-filter-btn" type="button" class="inline-flex items-center justify-center gap-2 bg-indigo-600 text-white py-2.5 px-5 rounded-xl hover:bg-indigo-700 font-semibold text-sm shadow-sm transition duration-150">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                </svg>
                Search & Filter Jobs
                @if(request()->hasAny(['job_type', 'job_category', 'province', 'town']))
                    <span class="ml-1 px-1.5 py-0.5 text-xs bg-indigo-800 rounded-full">Active</span>
                @endif
            </button>
        </div>
    </div>

    <!-- Backdrop Modal -->
    <div id="filter-modal" class="fixed inset-0 z-50 hidden bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center p-4 transition-opacity">
        <div class="w-full max-w-xl rounded-xl bg-white p-6 text-gray-600 shadow-xl relative">

            <div class="flex items-center justify-between border-b border-gray-100 pb-3 mb-4">
                <h3 class="text-lg font-bold text-gray-800">Advanced Job Search</h3>
                <button id="close-filter-btn" type="button" class="text-gray-400 hover:text-gray-600 p-1 rounded-lg hover:bg-gray-100 transition">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Filter Form -->
            <form action="{{ route('recommended') }}" method="GET">
                <!-- Keep show_all state context clean during new search form triggers -->
                @if(request()->has('show_all'))
                    <input type="hidden" name="show_all" value="1">
                @endif

                <div class="space-y-4 mb-6">
                    <div>
                        <label for="job_type" class="block text-sm font-medium text-gray-700 mb-1">Type of Job</label>
                        <select id="job_type" name="job_type" class="block w-full text-sm rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value=""></option>
                            <option value="Full Time" {{ request('job_type') == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                            <option value="Part Time" {{ request('job_type') == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                            <option value="Contract / Freelance" {{ request('job_type') == 'Contract / Freelance' ? 'selected' : '' }}>Contract / Freelance</option>
                            <option value="Temporary / Seasonal" {{ request('job_type') == 'Temporary / Seasonal' ? 'selected' : '' }}>Temporary / Seasonal</option>
                        </select>
                    </div>

                    <div>
                        <label for="job_category" class="block text-sm font-medium text-gray-700 mb-1">Category of Job</label>
                        <select id="job_category" name="job_category" class="block w-full text-sm rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value=""></option>
                            @foreach($expertise as $item)
                                <option value="{{ $item->id }}" {{ request('job_category') == $item->id ? 'selected' : '' }}>{{ $item->area_of_expertise }}</option>
                            @endforeach
                        </select>
                    </div>

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

                <div class="flex items-center justify-end gap-2 pt-4 border-t border-gray-100">
                    @if(request()->hasAny(['job_type', 'job_category', 'province', 'town']))
                        <a href="{{ route('recommended', request()->only(['show_all'])) }}" class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-md transition">
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
        <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-5 rounded-xl flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-3">
                <svg class="h-5 w-5 text-yellow-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span class="text-sm font-medium">
                    No jobs found matching your specific filtering or skills criteria.
                </span>
            </div>

            @if(!request()->has('show_all'))
                <a href="{{ route('recommended', array_merge(request()->query(), ['show_all' => 1])) }}"
                   class="inline-flex items-center justify-center gap-2 rounded-lg bg-yellow-600 px-4 py-2 text-xs font-semibold text-white shadow-sm hover:bg-yellow-700 transition focus:outline-none whitespace-nowrap">
                    Show All Job Vacancies
                </a>
            @endif
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

    const provinceSelect = document.getElementById('province');
    const townSelect = document.getElementById('town');

    const provincesUrl = "{{ url('/api/provinces') }}";
    const townsUrl     = "{{ url('/api/towns') }}";

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
                    opt.value = t.town; // <--- FIX: Changed from t.id to t.town
                    opt.textContent = t.town;
                    if(t.town === "{{ request('town') }}") opt.selected = true;
                    townSelect.appendChild(opt);
                });
                townSelect.disabled = false;
            });
    });
});
</script>
</x-app-layout> --}}
<x-app-layout>
<div class="container mx-auto px-4 py-8">
    <!-- Header with Toggle Button -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            @if(request()->has('show_all'))
                <h1 class="text-2xl font-bold text-gray-800">All Job Vacancies</h1>
                <p class="text-sm text-gray-600">
                    Showing the complete list of all active vacancies with no search or profile filters applied.
                </p>
            @else
                <h1 class="text-2xl font-bold text-gray-800">Job Recommendations For You</h1>
                <p class="text-sm text-gray-600">
                    Showing active jobs matched to your skills profile alongside behavioral peer recommendations.
                </p>
            @endif
        </div>

        <!-- Filter Toggle and Reset Buttons -->
        <div class="flex items-center gap-2 self-start sm:self-center">
            @if(request()->has('show_all') || request()->hasAny(['job_type', 'course', 'province', 'town']))
                <a href="{{ route('recommended') }}" class="inline-flex items-center justify-center bg-gray-100 border border-gray-200 text-gray-700 py-2.5 px-4 rounded-xl hover:bg-gray-200 font-semibold text-sm transition duration-150 shadow-sm">
                    Reset View
                </a>
            @endif

            <button id="open-filter-btn" type="button" class="inline-flex items-center justify-center gap-2 bg-indigo-600 text-white py-2.5 px-5 rounded-xl hover:bg-indigo-700 font-semibold text-sm shadow-sm transition duration-150">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                </svg>
                Search & Filter Jobs
                @if(request()->hasAny(['job_type', 'course', 'province', 'town']))
                    <span class="ml-1 px-1.5 py-0.5 text-xs bg-indigo-800 rounded-full">Active</span>
                @endif
            </button>
        </div>
    </div>

    <!-- Backdrop Modal -->
    <div id="filter-modal" class="fixed inset-0 z-50 hidden bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center p-4 transition-opacity">
        <div class="w-full max-w-xl rounded-xl bg-white p-6 text-gray-600 shadow-xl relative">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3 mb-4">
                <h3 class="text-lg font-bold text-gray-800">Advanced Job Search</h3>
                <button id="close-filter-btn" type="button" class="text-gray-400 hover:text-gray-600 p-1 rounded-lg hover:bg-gray-100 transition">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Filter Form -->
            <form action="{{ route('recommended') }}" method="GET">
                @if(request()->has('show_all'))
                    <input type="hidden" name="show_all" value="1">
                @endif

                <div class="space-y-4 mb-6">
                    <div>
                        <label for="job_type" class="block text-sm font-medium text-gray-700 mb-1">Type of Job</label>
                        <select id="job_type" name="job_type" class="block w-full text-sm rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value=""></option>
                            <option value="Full Time" {{ request('job_type') == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                            <option value="Part Time" {{ request('job_type') == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                            <option value="Contract / Freelance" {{ request('job_type') == 'Contract / Freelance' ? 'selected' : '' }}>Contract / Freelance</option>
                            <option value="Temporary / Seasonal" {{ request('job_type') == 'Temporary / Seasonal' ? 'selected' : '' }}>Temporary / Seasonal</option>
                        </select>
                    </div>

                    <div>
                        <label for="course" class="block text-sm font-medium text-gray-700 mb-1">Filter by Course</label>
                        <select id="course" name="course" class="block w-full text-sm rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value=""></option>
                            @foreach($courses as $c)
                                <option value="{{ $c->display_name }}" {{ request('course') == $c->display_name ? 'selected' : '' }}>{{ $c->display_name }}</option>
                            @endforeach
                        </select>
                    </div>

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

                <div class="flex items-center justify-end gap-2 pt-4 border-t border-gray-100">
                    @if(request()->hasAny(['job_type', 'course', 'province', 'town']))
                        <a href="{{ route('recommended', request()->only(['show_all'])) }}" class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-md transition">
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

    <!-- 2-COLUMN MAIN LAYOUT SPLIT -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        <!-- BLUE SECTION: PROFILE MATRIX & GEOSPATIAL ANALYSIS -->
        <div>
            <div class="mb-4 pb-2 border-b-2 border-blue-400">
                <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                    <span class="h-3 w-3 rounded-full bg-blue-500"></span>
                    Jobs matched to your skills / near you
                </h2>
                <p class="text-xs text-gray-500">Matched to your skills/background and ordered by closest distance.</p>
            </div>

            @if($jobs->isEmpty())
                <div class="bg-gray-50 border border-gray-200 text-gray-500 p-4 rounded-xl text-sm">
                    No qualification matches found in your area.
                </div>
            @else
                <div class="space-y-4">
                    @foreach($jobs as $job)
                        <div class="bg-white border-l-4 border-blue-400 border-t border-r border-b border-gray-200 rounded-r-xl p-5 shadow-sm hover:shadow transition">
                            <div class="flex justify-between items-start gap-2">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 leading-snug">{{ $job->job_title }}</h3>
                                    <p class="text-xs text-gray-500 font-medium tracking-wide">
                                        {{ isset($job->area_of_expertise) ? strtoupper($job->area_of_expertise) : 'GENERAL' }}
                                    </p>
                                </div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-50 text-blue-800 whitespace-nowrap">
                                    {{ round($job->distance, 1) }} km away
                                </span>
                            </div>

                            <div class="mt-3 flex flex-wrap gap-2 text-xs text-gray-500">
                                <div><span class="font-medium text-gray-700">Type:</span> {{ $job->job_type }}</div>
                                <span class="text-gray-300">•</span>
                                <div><span class="font-medium text-gray-700">Loc:</span> {{ $job->barangay }}, {{ $job->town }}, {{ $job->province }}</div>
                            </div>

                            <div class="mt-4 pt-3 border-t border-gray-100 flex justify-between items-center">
                                <span class="text-xs text-gray-400">Posted {{ \Carbon\Carbon::parse($job->created_at)->diffForHumans() }}</span>
                                <a href="/recd/{{ $job->job_id }}" class="text-xs font-semibold text-blue-600 hover:text-blue-400">
                                    View Details &rarr;
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- GREEN SECTION: BEHAVIORAL COLLABORATIVE FILTERING -->
        @if($collaborativeJobs->isNotEmpty())
            <div>
                <div class="mb-4 pb-2 border-b-2 border-green-400">
                    <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <span class="h-3 w-3 rounded-full bg-green-500"></span>
                        People Also Viewed (Collaborative)
                    </h2>
                    <p class="text-xs text-gray-500">Recommended jobs based on what other applicants with similar searches are checking out.</p>
                </div>

                <div class="space-y-4">
                    @foreach($collaborativeJobs as $job)
                        <div class="bg-white border-l-4 border-green-400 border-t border-r border-b border-gray-200 rounded-r-xl p-5 shadow-sm hover:shadow transition">
                            <div class="flex justify-between items-start gap-2">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 leading-snug">{{ $job->job_title }}</h3>
                                    <p class="text-xs text-gray-500 font-medium tracking-wide">
                                        {{ isset($job->area_of_expertise) ? strtoupper($job->area_of_expertise) : 'GENERAL' }}
                                    </p>
                                </div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-50 text-green-800 whitespace-nowrap">
                                    Peer Choice
                                </span>
                            </div>

                            <div class="mt-3 flex flex-wrap gap-2 text-xs text-gray-500">
                                <div><span class="font-medium text-gray-700">Type:</span> {{ $job->job_type }}</div>
                                <span class="text-gray-300">•</span>
                                <div><span class="font-medium text-gray-700">Loc:</span> {{ $job->barangay }}, {{ $job->town }}, {{ $job->province }}</div>
                            </div>

                            <div class="mt-4 pt-3 border-t border-gray-100 flex justify-between items-center">
                                <span class="text-xs text-gray-400">Posted {{ \Carbon\Carbon::parse($job->created_at)->diffForHumans() }}</span>
                                <a href="/recd/{{ $job->job_id }}" class="text-xs font-semibold text-green-600 hover:text-green-800">
                                    View Details &rarr;
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>

<!-- Modal & Async API Script Block -->
<script>
document.addEventListener('DOMContentLoaded', function () {
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

    const provinceSelect = document.getElementById('province');
    const townSelect = document.getElementById('town');

    const provincesUrl = "{{ url('/api/provinces') }}";
    const townsUrl     = "{{ url('/api/towns') }}";

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
                    if(t.town === "{{ request('town') }}") opt.selected = true;
                    townSelect.appendChild(opt);
                });
                townSelect.disabled = false;
            });
    });
});
</script>
</x-app-layout>
