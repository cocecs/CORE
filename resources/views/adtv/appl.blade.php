<x-app-layout>
    <div class="max-w-4xl mx-auto my-8 p-6 space-y-6 bg-slate-50 text-slate-800 antialiased font-sans">

        <!-- Top Action Buttons -->
        <div class="flex flex-wrap gap-3">
            @php
                // Fetch the specific interviewee record to read its pivot status
                $intervieweeRecord = $application->jobPosting->interviewees->where('idno', $user->idno)->first();
            @endphp

            <div class="flex items-center gap-3">
                @if($intervieweeRecord && $intervieweeRecord->pivot->status === 'interviewee')

                    <form action="{{ route('jobs.hireApplicant', ['job_id' => $application->job_id, 'idno' => $user->idno]) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="px-5 py-2.5 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-colors focus:outline-none">
                            On review
                        </button>
                    </form>

                @elseif($intervieweeRecord && $intervieweeRecord->pivot->status === 'hired')
                    <span class="px-4 py-2 bg-green-100 text-green-800 font-bold rounded-lg tracking-wide border border-green-200 flex items-center gap-1">
                        🎉 Hired
                    </span>
                @endif
            </div>
        </div>

        <!-- Applicant Header Profile Card -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex justify-between items-start">
            <div class="space-y-2">
                <!-- Combines user identity parameters cleanly -->
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">
                    {{ $userDetails->firstname ?? $user->name }} {{ $userDetails->middlename ?? '' }} {{ $userDetails->lastname ?? '' }} {{ $userDetails->ext ?? '' }}
                </h1>

                <!-- Dynamic Address Location String -->
                <div class="flex items-center gap-2 text-sm text-slate-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                    <span>
                        {{ $userDetails->barangay ?? 'N/A' }}, {{ $userDetails->town ?? 'Tangub City' }}, {{ $userDetails->province ?? 'Misamis Occidental' }}
                    </span>
                </div>

                <!-- Contact Email Target -->
                <div class="flex items-center gap-2 text-sm text-slate-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0l-7.5-4.615a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                    <a href="mailto:{{ $user->email }}" class="hover:underline text-blue-600">{{ $user->email }}</a>
                </div>
            </div>
        </div>

        <!-- Personal Summary Segment -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 space-y-4">
            <h2 class="text-xl font-bold text-slate-900 tracking-tight">Personal summary</h2>
            <p class="text-sm text-slate-600 leading-relaxed">
                {{ $userDetails->summary ?? 'No personal summary provided by the applicant yet.' }}
            </p>
        </div>

        <!-- Core Profile Skills Block -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <h2 class="text-3xl font-bold tracking-tight text-[#1e2d56] mb-6">Skills</h2>
            <div class="flex flex-wrap gap-x-3 gap-y-4 mb-4">
                @forelse(json_decode($userDetails->skills ?? '[]') as $skill)
                    <span class="px-5 py-2.5 bg-[#f4f6f9] text-[#2c3e50] rounded-full text-[15px] font-medium transition hover:bg-[#eaf0f6] cursor-pointer">
                        {{ $skill }}
                    </span>
                @empty
                    <p class="text-sm text-gray-500">No specific skills indexed.</p>
                @endforelse
            </div>
        </div>

        <!-- Education Milestones Timeline -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 space-y-6">
            <h2 class="text-3xl font-bold tracking-tight text-[#1e2d56] mb-6">Education</h2>

            <!-- Structural Card Item -->
            <div class="bg-white border border-[#e2e8f0] rounded-2xl p-6 relative shadow-xs">
                <span class="inline-block bg-[#fae8ff] text-[#b512b0] text-xs font-semibold px-3 py-1 rounded-md mb-3">
                    Found in resumé
                </span>
                <h3 class="text-xl font-bold text-[#1e2d56] mb-1">{{ $userDetails->degree ?? 'Bachelor of Science in Information Technology' }}</h3>
                <p class="text-[#475569] text-[16px] mb-1">{{ $userDetails->school ?? 'Misamis University' }}</p>
                <p class="text-[#64748b] text-[15px]">Year Graduated: {{ $userDetails->grad_year ?? '2014' }}</p>
            </div>
        </div>

        <!-- Bottom Action Sticky Bar alternative -->
        <div class="flex flex-wrap gap-3 pt-4 border-t border-slate-100">
            <div class="flex items-center gap-3">
                @if($intervieweeRecord && $intervieweeRecord->pivot->status === 'interviewee')

                    <form action="{{ route('jobs.hireApplicant', ['job_id' => $application->job_id, 'idno' => $user->idno]) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="px-5 py-2.5 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-colors focus:outline-none">
                            On review
                        </button>
                    </form>

                @elseif($intervieweeRecord && $intervieweeRecord->pivot->status === 'hired')
                    <span class="px-4 py-2 bg-green-100 text-green-800 font-bold rounded-lg tracking-wide border border-green-200 flex items-center gap-1">
                        🎉 Hired
                    </span>
                @endif
            </div>
        </div>

    </div>
</x-app-layout>
