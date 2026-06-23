<x-app-layout>
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col justify-between items-center mb-6">
        @if ($errors->any())
            @error('exploring_job')
                <h2 class="text-1xl font-semibold text-red-600">* {{ $message }}</h2>
            @enderror
        @else
            <h2 class="text-1xl font-semibold text-blue-700">Do you have a specific reason for exploring new job?</h2>
        @endif
    </div>
</div>
<form action="" method="POST">
@csrf
@method('PUT')
<div class="max-w-3xl mx-auto p-6 bg-gray-50 space-y-4">
    <div class="flex items-center space-x-2 pb-2">
        <h2 class="text-2xl font-bold text-gray-800">Recommended</h2>
        <button class="text-gray-500 hover:text-gray-700 focus:outline-none" title="Information">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 111.063.852l-.708 2.836a.75.75 0 001.063.852l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
            </svg>
        </button>
    </div>

    @foreach($jobs as $job)
        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow relative flex flex-col md:flex-row justify-between items-start gap-4">

            <div class="space-y-2 flex-1 w-full">
                @if($job->is_new)
                    <div class="inline-block bg-emerald-50 text-emerald-700 text-xs font-medium px-2.5 py-1 rounded-md">
                        New to you
                    </div>
                @endif

                <h3 class="text-xl font-semibold text-gray-800 hover:text-blue-600 cursor-pointer">
                    {{ $job->job_title }}
                </h3>
                <h5 class="text-lg font-medium text-gray-600 cursor-pointer">
                    {{ $job->company_name }}
                </h5>

                <div class="text-gray-700 text-base py-1 wysiwyg-content">
                    {!! $job->job_description !!}
                </div>

                <div class="text-gray-500 text-sm pt-1 space-y-0.5">
                    <p>{{ $job->job_type }}</p>
                    <p>{{ $job->place_of_work }} @if($job->is_remote) (Remote) @endif</p>
                </div>

                <p class="text-gray-400 text-xs pt-2">
                    {{ $job->created_at->diffForHumans() }}
                </p>
            </div>

            <div class="flex flex-col items-end justify-between h-full min-w-[120px] self-stretch">
                <div class="mb-4 md:mb-0">
                    @if($job->company_logo)
                        <img src="{{ asset('storage/' . $job->company_logo) }}" alt="{{ $job->company_name }} Logo" class="h-12 w-auto object-contain max-w-[120px]">
                    @else
                        <div class="h-12 w-12 bg-gray-100 rounded flex items-center justify-center text-gray-400 font-bold">
                            {{ Str::limit($job->company_name, 2, '') }}
                        </div>
                    @endif
                </div>

                <div class="flex items-center space-x-4 pt-4 md:pt-0 mt-auto">
                    <button class="text-gray-700 hover:text-blue-600 focus:outline-none" title="Save Job">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                        </svg>
                    </button>

                    <button class="flex items-center space-x-1 text-gray-700 hover:text-red-600 focus:outline-none font-medium text-sm" title="Hide Job">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        <span>Hide</span>
                    </button>
                </div>
            </div>

        </div>
    @endforeach
</div>

<style>
    .wysiwyg-content p {
        margin-bottom: 0.5rem;
    }
    .wysiwyg-content p:last-child {
        margin-bottom: 0;
    }
    .wysiwyg-content strong {
        font-weight: 700 !important;
        color: #1f2937;
    }
    .wysiwyg-content ul {
        list-style-type: disc !important;
        margin-left: 1.25rem !important;
        margin-top: 0.25rem;
        margin-bottom: 0.5rem;
    }
    .wysiwyg-content ol {
        list-style-type: decimal !important;
        margin-left: 1.25rem !important;
        margin-top: 0.25rem;
        margin-bottom: 0.5rem;
    }
    .wysiwyg-content li {
        margin-bottom: 0.25rem;
    }
</style>
</form>


</x-app-layout>

