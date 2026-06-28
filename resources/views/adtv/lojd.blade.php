<x-app-layout>
<div class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-6xl mx-auto mb-6">
        <a href="{{ route('listJobs') }}" class="text-sm font-semibold text-red-600 hover:text-red-800 transition-colors">&larr; Back to Job Postings</a>
        <h1 class="text-3xl font-bold text-gray-900 mt-2">{{ $job->job_title }}</h1>
        <p class="text-sm text-gray-500 font-mono mt-1">Internal Job ID: {{ $job->job_id }}</p>
    </div>

    <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 space-y-4">
            <h2 class="text-base font-bold text-gray-900 border-b pb-2">Posting Overview</h2>

            <div>
                <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Category Code</span>
                <span class="text-sm font-medium text-gray-800">{{ $job->job_category }}</span>
            </div>
            <div>
                <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Employment Type</span>
                <span class="text-sm font-medium text-gray-800">{{ $job->job_type }}</span>
            </div>
            <div>
                <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Target Positions</span>
                <span class="text-sm font-medium text-gray-800">{{ $job->num_positions }} open slots</span>
            </div>
            <div>
                <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Assigned Region / Location</span>
                <span class="text-sm font-medium text-gray-800">{{ $job->barangay }}, {{ $job->town }}, {{ $job->province }}</span>
            </div>
            <div>
                <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Applicants:</span>
                <span class="text-sm font-medium text-gray-800">{{ $jobApp }}</span>
                <a href="{{ route('jobApplicants', $job->job_id) }}" class="block text-xs font-semibold text-blue-600 hover:text-blue-800 hover:underline uppercase tracking-wider mt-1 transition duration-150 ease-in-out">
                    Show Applicants &rarr;
                </a>
            </div>
        </div>

        <div class="lg:col-span-2 bg-white p-8 rounded-xl shadow-sm border border-gray-100 space-y-6">

            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-3 border-b pb-1">Job Description</h3>
                <div class="prose max-w-none text-gray-700 leading-relaxed text-sm">
                    {!! $job->job_description !!}
                </div>
            </div>

            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-3 border-b pb-1">Requirements</h3>
                <div class="prose max-w-none text-gray-700 leading-relaxed text-sm">
                    {!! $job->job_requirements !!}
                </div>
            </div>

        </div>
    </div>
</div>
</x-app-layout>

