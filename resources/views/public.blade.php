<x-guest-layout>
    <!-- Top Navigation Bar for Public Guests -->
    <nav class="bg-white border-b border-gray-200">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="/" class="text-xl font-bold text-indigo-600">PESO Job Portal</a>
            <div class="flex items-center gap-3">
                <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 hover:text-indigo-600">Sign In</a>
                <a href="{{ route('register') }}" class="text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-lg transition">Create Account</a>
            </div>
        </div>
    </nav>
    <div class="container mx-auto px-4 py-8">
        <!-- Guest Call to Action Banner -->
        <div class="mb-8 p-6 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl text-white shadow-md flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-bold">Looking for personalized recommendations?</h2>
                <p class="text-indigo-100 text-sm mt-1">Sign in or create a profile to get job matches based on your exact skills, education, and distance.</p>
            </div>
            <a href="{{ route('register') }}" class="bg-white text-indigo-600 font-bold px-5 py-2.5 rounded-xl text-sm shadow hover:bg-indigo-50 transition whitespace-nowrap">
                Get Personalized Matches
            </a>
        </div>

        <!-- Header with Filter Controls -->
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Available Job Vacancies</h1>
                <p class="text-sm text-gray-600">Browse all active job openings across the region.</p>
            </div>

            <!-- Filter Toggle & Reset Buttons -->
            <div class="flex items-center gap-2 self-start sm:self-center">
                @if(request()->hasAny(['job_type', 'course', 'province', 'town']))
                    <a href="{{ route('public.jobs') }}" class="inline-flex items-center justify-center bg-gray-100 border border-gray-200 text-gray-700 py-2.5 px-4 rounded-xl hover:bg-gray-200 font-semibold text-sm transition shadow-sm">
                        Reset View
                    </a>
                @endif

                <button id="open-filter-btn" type="button" class="inline-flex items-center justify-center gap-2 bg-indigo-600 text-white py-2.5 px-5 rounded-xl hover:bg-indigo-700 font-semibold text-sm shadow-sm transition">
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
        <!-- Filter Modal -->
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

                <form action="{{ route('public.jobs') }}" method="GET">
                    <div class="space-y-4 mb-6">
                        <div>
                            <label for="job_type" class="block text-sm font-medium text-gray-700 mb-1">Type of Job</label>
                            <select id="job_type" name="job_type" class="block w-full text-sm rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">All Job Types</option>
                                <option value="Full Time" {{ request('job_type') == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                                <option value="Part Time" {{ request('job_type') == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                                <option value="Contract / Freelance" {{ request('job_type') == 'Contract / Freelance' ? 'selected' : '' }}>Contract / Freelance</option>
                                <option value="Temporary / Seasonal" {{ request('job_type') == 'Temporary / Seasonal' ? 'selected' : '' }}>Temporary / Seasonal</option>
                            </select>
                        </div>

                        <div>
                            <label for="course" class="block text-sm font-medium text-gray-700 mb-1">Filter by Required Field / Course</label>
                            <select id="course" name="course" class="block w-full text-sm rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">All Fields</option>
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
                            <a href="{{ route('public.jobs') }}" class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-md transition">
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

        <!-- JOB LISTINGS GRID -->
        @if($jobs->isEmpty())
            <div class="bg-white border border-gray-200 text-gray-500 p-8 rounded-2xl text-center shadow-sm">
                <p class="text-base font-semibold text-gray-700">No job postings matched your filters.</p>
                <p class="text-xs text-gray-400 mt-1">Try resetting your filter parameters to see all vacancies.</p>
            </div>
        @else
            <div class="grid gap-6">
                @foreach($jobs as $job)
                    <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start gap-2">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 leading-snug">{{ $job->job_title }}</h3>
                                    <p class="text-xs text-indigo-600 font-semibold tracking-wide mt-0.5">
                                        {{ isset($job->area_of_expertise) ? strtoupper($job->area_of_expertise) : 'GENERAL' }}
                                    </p>
                                </div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 whitespace-nowrap">
                                    {{ $job->job_type }}
                                </span>
                            </div>

                            <div class="mt-3 text-xs text-gray-500">
                                <div><span class="font-medium text-gray-700">Location:</span> {{ $job->barangay }}, {{ $job->town }}, {{ $job->province }}</div>
                            </div>
                        </div>

                        <div class="mt-5 pt-3 border-t border-gray-100 flex justify-between items-center">
                            <span class="text-xs text-gray-400">Posted {{ \Carbon\Carbon::parse($job->created_at)->diffForHumans() }}</span>
                            <a href="{{ route('public.show', $job->id) }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 inline-flex items-center gap-1 transition">
                                View Job Details &rarr;
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Links -->
            <div class="mt-6">
                {{ $jobs->links() }}
            </div>
        @endif
    </div>

    <!-- Script Block -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('filter-modal');
        const openBtn = document.getElementById('open-filter-btn');
        const closeBtn = document.getElementById('close-filter-btn');

        openBtn.addEventListener('click', () => modal.classList.remove('hidden'));
        closeBtn.addEventListener('click', () => modal.classList.add('hidden'));

        modal.addEventListener('click', function(e) {
            if (e.target === modal) modal.classList.add('hidden');
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
</x-guest-layout>
