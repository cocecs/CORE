<x-app-layout>
<div class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-6xl mx-auto mb-6">
        <a href="{{ redirect()->back() }}" class="text-sm font-semibold text-red-600 hover:text-red-800 transition-colors">&larr; Back to Job Postings</a>
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
            <!-- Added: Salary / Compensation Display -->
            <div>
                <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Salary / Compensation</span>
                <span class="text-sm font-medium text-gray-800">
                    {{ $job->salary_range ? '₱' . number_format($job->salary_range, 2) : 'Not Specified' }}
                </span>
            </div>
            <div>
                <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Applicants:</span>
                <span class="text-sm font-medium text-gray-800">{{ $jobApp }}</span>
                <a href="{{ route('jobApplicants', $job->job_id) }}" class="block text-xs font-semibold text-blue-600 hover:text-blue-800 hover:underline uppercase tracking-wider mt-1 transition duration-150 ease-in-out">
                    Show Applicants &rarr;
                </a>
            </div>
            <div class="pt-4 border-t border-gray-100">
                <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Share Opportunity</span>
                <button type="button"
                        onclick="shareJobLink('{{ route('public.show', $job->job_id ?? $job->id) }}', '{{ addslashes($job->job_title) }}', this)"
                        class="w-full inline-flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold text-xs py-2.5 px-4 rounded-lg transition-all shadow-sm focus:outline-none">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                    </svg>
                    <span class="btn-text">Share Job Posting</span>
                </button>
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
    <script>
    function shareJobLink(url, title, btnElement) {
        const textLabel = btnElement.querySelector('.btn-text');

        // Web Share API support (Mobile / Modern Browsers)
        if (navigator.share) {
            navigator.share({
                title: title,
                text: 'Check out this job posting: ' + title,
                url: url
            }).catch(err => console.log('Share canceled or failed:', err));
        } else {
            // Fallback: Copy link directly to Clipboard
            navigator.clipboard.writeText(url).then(() => {
                if (textLabel) {
                    const originalText = textLabel.textContent;
                    textLabel.textContent = 'Link Copied!';
                    btnElement.classList.add('bg-green-100', 'text-green-800');

                    setTimeout(() => {
                        textLabel.textContent = originalText;
                        btnElement.classList.remove('bg-green-100', 'text-green-800');
                    }, 2000);
                }
            }).catch(err => {
                alert('Could not copy link: ' + url);
            });
        }
    }
    </script>
</div>
</x-app-layout>

