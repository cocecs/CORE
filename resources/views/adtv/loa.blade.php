<x-app-layout>
<div class="py-8 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header Section -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">
                Applicants for {{ $job->title }}
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                Reviewing active submissions for Job ID: <span class="font-semibold text-blue-600">#{{ $job->job_id }}</span>
            </p>
        </div>

        <!-- Table Container Card -->
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100 text-left">
                    <!-- Table Header -->
                    <thead class="bg-gray-50/70">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-xs font-bold text-amber-900/80 uppercase tracking-wider w-16">
                                No.
                            </th>
                            <th scope="col" class="px-6 py-4 text-xs font-bold text-amber-900/80 uppercase tracking-wider">
                                Applicant Name
                            </th>
                            <th scope="col" class="px-6 py-4 text-xs font-bold text-amber-900/80 uppercase tracking-wider">
                                Applicant ID
                            </th>
                            <th scope="col" class="px-6 py-4 text-xs font-bold text-amber-900/80 uppercase tracking-wider">
                                Contact Email
                            </th>
                            <th scope="col" class="px-6 py-4 text-xs font-bold text-amber-900/80 uppercase tracking-wider">
                                Location
                            </th>
                            <th scope="col" class="px-6 py-4 text-xs font-bold text-amber-900/80 uppercase tracking-wider text-right pr-8">
                                Action
                            </th>
                        </tr>
                    </thead>

                    <!-- Table Body -->
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($applicants as $index => $applicant)
                            <tr class="hover:bg-gray-50/50 transition duration-150 ease-in-out">
                                <!-- Row Number -->
                                <td class="px-6 py-5 text-sm font-medium text-gray-400">
                                    {{ $index + 1 }}
                                </td>

                                <!-- Applicant Name -->
                                <td class="px-6 py-5 text-sm font-bold text-gray-900">
                                    {{ $applicant->name }}
                                </td>

                                <!-- Applicant ID String -->
                                <td class="px-6 py-5 text-sm text-slate-500 font-medium">
                                    {{ $applicant->idno ?? $applicant->id }}
                                </td>

                                <!-- Contact Info / Category replacement -->
                                <td class="px-6 py-5 text-sm text-gray-600">
                                    {{ $applicant->email }}
                                </td>

                                <!-- Location / Address -->
                                <td class="px-6 py-5 text-sm text-slate-500 font-medium">
                                    {{ $applicant->address ?? '1, Misamis Occidental' }}
                                </td>

                                <!-- Red Action Button matching image styling -->
                                <td class="px-6 py-5 text-sm text-right pr-8 whitespace-nowrap">
                                    <a href="{{ route('applProfile', ['idno' => $applicant->idno ?? $applicant->id, 'job_id' => $job->job_id]) }}"
                                       class="inline-flex items-center justify-center px-5 py-2.5 bg-[#dc2626] hover:bg-[#b91c1c] text-white text-xs font-bold rounded-xl transition-colors duration-150 ease-in-out shadow-sm tracking-wide">
                                        View Profile
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <!-- Empty Row View -->
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-sm text-gray-500 italic bg-white">
                                    No applicants have submitted forms for this position yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
</x-app-layout>

