<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold leading-tight text-gray-800">
            {{ __('List of Posted Jobs') }}
        </h2>
    </x-slot>

@csrf
<!-- Added w-full and max-w-5xl to the table wrapper -->
<div class="bg-gray-100 min-h-screen p-6">
    <div class="flex justify-between items-center max-w-7xl mx-auto mb-4">
        <h1 class="text-xl font-bold text-gray-900 tracking-tight">Job Postings</h1>
        <span class="bg-red-100 text-red-700 text-xs font-semibold px-2.5 py-1 rounded-full">
            Total: {{ $totalJobs }}
        </span>
    </div>

    <div class="max-w-7xl mx-auto bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-orange-50/40 border-b border-gray-100 text-[11px] font-bold tracking-wider text-amber-900 uppercase">
                        <th class="py-4 px-6 w-16">No.</th>
                        <th class="py-4 px-6">Job Title</th>
                        <th class="py-4 px-6">Job ID</th>
                        <th class="py-4 px-6">Category</th>
                        <th class="py-4 px-6">Location</th>
                        <th class="py-4 px-6 text-right">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($jobs as $index => $job)
                        <tr class="hover:bg-gray-50/50 transition-colors duration-150">
                            <td class="py-4 px-6 text-gray-400 font-medium">
                                {{ $index + 1 }}
                            </td>
                            <td class="py-4 px-6 font-semibold text-gray-900">
                                {{ $job->job_title }}
                            </td>
                            <td class="py-4 px-6 text-gray-500 font-mono">
                                {{ $job->job_id }}
                            </td>
                            <td class="py-4 px-6 text-gray-600">
                                {{ $job->job_category }}
                            </td>
                            <td class="py-4 px-6 text-gray-500">
                                {{ $job->town }}, {{ $job->province }}
                            </td>
                            <td class="py-4 px-6 text-right whitespace-nowrap">
                                <a href="{{ route('jobDetails', $job->job_id) }}" class="inline-flex items-center justify-center bg-red-600 hover:bg-red-700 text-white font-medium text-xs px-4 py-2 rounded-lg transition-colors shadow-sm">
                                    Manage Job
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 px-6 text-center text-gray-400 bg-gray-50/50">
                                No active job postings found inside the database structure.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

</x-app-layout>
