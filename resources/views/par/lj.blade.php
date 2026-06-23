<x-app-layout>
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


    <div class="flex flex-col justify-between items-center">
        @if ($errors->has('firstname') || $errors->has('lastname') || $errors->has('date_of_birth'))
            {{-- This shows if any of the three fields fail validation --}}
            <h2 class="text-1xl font-semibold text-red-600">
                * Please check your details. Some required fields are missing.
            </h2>
        @else
            <h2 class="text-1xl font-semibold text-blue-700">
                List of jobs posted
            </h2>
        @endif
    </div>
</div>

@csrf
<!-- Added w-full and max-w-5xl to the table wrapper -->
<div class="flex items-center justify-center w-full">
    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm mx-8 my-12 md:mx-0 md:my-0 w-full max-w-6xl">
        <div class="space-y-12 p-6">

            <div>
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-900 tracking-tight">Job Postings Management</h2>
                    <span class="inline-flex items-center rounded-full bg-red-100 px-3 py-0.5 text-xs font-medium text-red-800">
                        Total: {{ $jobs->count() }}
                    </span>
                </div>

                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 bg-white text-sm table-fixed">
                        <thead class="bg-red-50 text-left font-medium text-red-900">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-xs uppercase tracking-wider w-20">No.</th>
                                <th scope="col" class="px-6 py-3 text-xs uppercase tracking-wider w-1/2">Job Title & Details</th>
                                <th scope="col" class="px-6 py-3 text-xs uppercase tracking-wider w-1/4">Category / Type</th>
                                <th scope="col" class="px-6 py-3 text-xs uppercase tracking-wider text-center w-32">Status</th>
                                <th scope="col" class="px-6 py-3 text-xs uppercase tracking-wider text-right w-40">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-gray-900">
                            @forelse($jobs as $job)
                                <tr class="hover:bg-red-50/30 transition-colors">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-500">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-6 py-4 font-semibold text-gray-900">
                                        <div class="text-gray-900 font-bold">{{ $job->job_title }}</div>
                                        <div class="text-xs text-gray-400 font-normal">ID: #{{ $job->job_id }}</div>
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-gray-600">
                                        <span class="block text-gray-900">{{ $job->job_category }}</span>
                                        <span class="text-xs text-gray-500 font-medium">{{ $job->job_type }}</span>
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-center">
                                        @if($job->is_active)
                                            <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">
                                                Active
                                            </span>
                                        @else
                                            <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-right">
                                        <a href="{{ route('emp_postc', ['job_id' => $job->job_id]) }}" class="inline-flex items-center rounded-md bg-red-600 px-4 py-1.5 text-xs font-semibold text-white shadow-sm hover:bg-red-500 transition-colors">
                                            Manage Job
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="whitespace-nowrap px-6 py-8 text-center text-gray-500 italic bg-gray-50">
                                        No job postings found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>



        </div>
    </div>
</div>

</x-app-layout>
