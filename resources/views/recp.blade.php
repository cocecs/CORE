<x-app-layout>
<div class="max-w-4xl mx-auto my-8 p-6 space-y-6 bg-slate-50 text-slate-800 antialiased font-sans">

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex justify-between items-start">
        <div class="space-y-2">
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">{{ $user->firstname }} {{ $user->middlename }} {{ $user->lastname }} {{ $user->ext }}</h1>

            <div class="flex items-center gap-2 text-sm text-slate-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                </svg>
                <span>{{ $user->barangay }}, {{ $user->town }}, {{ $user->province }}</span>
            </div>

            <div class="flex items-center gap-2 text-sm text-slate-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0l-7.5-4.615a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                </svg>
                <a href="mailto:act.undag@gmail.com" class="hover:underline">{{ $user->email }}</a>
            </div>
        </div>

        <button class="p-2 text-slate-500 hover:text-indigo-600 hover:bg-slate-50 rounded-full transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
            </svg>
        </button>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 space-y-4">
        <h2 class="text-xl font-bold text-slate-900 tracking-tight">Personal summary</h2>
        <p class="text-sm text-slate-600 leading-relaxed">
            Add a personal summary to your profile as a way to introduce who you are.
        </p>
        <button class="px-5 py-2 text-sm font-semibold text-indigo-700 bg-white border-2 border-indigo-700 rounded-xl hover:bg-indigo-50/50 active:bg-indigo-50 transition-colors">
            Add summary
        </button>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
        <!-- Header -->
        <h2 class="text-3xl font-bold tracking-tight text-[#1e2d56] mb-6">Skills</h2>

        <!-- Skills Tags Wrap -->
        <div class="flex flex-wrap gap-x-3 gap-y-4 mb-8">
            <span class="px-5 py-2.5 bg-[#f4f6f9] text-[#2c3e50] rounded-full text-[15px] font-medium transition hover:bg-[#eaf0f6] cursor-pointer">Social Media</span>
            <span class="px-5 py-2.5 bg-[#f4f6f9] text-[#2c3e50] rounded-full text-[15px] font-medium transition hover:bg-[#eaf0f6] cursor-pointer">Social Media Platforms</span>
            <span class="px-5 py-2.5 bg-[#f4f6f9] text-[#2c3e50] rounded-full text-[15px] font-medium transition hover:bg-[#eaf0f6] cursor-pointer">Digital Marketing</span>
            <span class="px-5 py-2.5 bg-[#f4f6f9] text-[#2c3e50] rounded-full text-[15px] font-medium transition hover:bg-[#eaf0f6] cursor-pointer">Graphic Design</span>
            <span class="px-5 py-2.5 bg-[#f4f6f9] text-[#2c3e50] rounded-full text-[15px] font-medium transition hover:bg-[#eaf0f6] cursor-pointer">Photography</span>
            <span class="px-5 py-2.5 bg-[#f4f6f9] text-[#2c3e50] rounded-full text-[15px] font-medium transition hover:bg-[#eaf0f6] cursor-pointer">Photo And Video Editing</span>
            <span class="px-5 py-2.5 bg-[#f4f6f9] text-[#2c3e50] rounded-full text-[15px] font-medium transition hover:bg-[#eaf0f6] cursor-pointer">Web Programming</span>
            <span class="px-5 py-2.5 bg-[#f4f6f9] text-[#2c3e50] rounded-full text-[15px] font-medium transition hover:bg-[#eaf0f6] cursor-pointer">3D Modeling</span>
        </div>

        <!-- Add Skills Button -->
        <button class="px-6 py-3 border-2 border-[#2b3a8f] text-[#2b3a8f] font-semibold text-lg rounded-xl hover:bg-[#2b3a8f]/5 active:bg-[#2b3a8f]/10 transition-colors focus:outline-none focus:ring-2 focus:ring-[#2b3a8f]/50">
            Add skills
        </button>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 space-y-6">

        <h2 class="text-3xl font-bold tracking-tight text-[#1e2d56] mb-6">Education</h2>
        <!-- Card 1 -->
        <div class="bg-white border border-[#e2e8f0] rounded-2xl p-6 relative shadow-xs">
            <!-- Badge -->
            <span class="inline-block bg-[#fae8ff] text-[#b512b0] text-xs font-semibold px-3 py-1 rounded-md mb-3">
                Found in resumé
            </span>

            <!-- Edit Icon (Positioned Absolute) -->
            <button class="absolute top-6 right-6 text-[#475569] hover:text-slate-900 focus:outline-none" aria-label="Edit entry">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                </svg>
            </button>

            <!-- Card Content -->
            <h3 class="text-xl font-bold text-[#1e2d56] mb-1">Bachelor of Science</h3>
            <p class="text-[#475569] text-[16px] mb-1">Misamis University</p>
            <p class="text-[#64748b] text-[15px] mb-5">Finished 2014</p>

            <!-- Action Buttons -->
            <div class="flex flex-wrap gap-3">
                <button class="px-5 py-2.5 bg-[#2b3a8f] text-white font-semibold rounded-lg hover:bg-[#202c70] transition-colors focus:outline-none">
                    Add to Profile
                </button>
                <button class="px-5 py-2.5 border border-[#2b3a8f] text-[#2b3a8f] font-semibold rounded-lg hover:bg-[#2b3a8f]/5 transition-colors focus:outline-none">
                    Don't include
                </button>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white border border-[#e2e8f0] rounded-2xl p-6 relative shadow-xs">
            <!-- Badge -->
            <span class="inline-block bg-[#fae8ff] text-[#b512b0] text-xs font-semibold px-3 py-1 rounded-md mb-3">
                Found in resumé
            </span>

            <!-- Edit Icon -->
            <button class="absolute top-6 right-6 text-[#475569] hover:text-slate-900 focus:outline-none" aria-label="Edit entry">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                </svg>
            </button>

            <!-- Card Content -->
            <h3 class="text-xl font-bold text-[#1e2d56] mb-1">Bachelor of Science in Information Technology</h3>
            <p class="text-[#475569] text-[16px] mb-1">Misamis University</p>
            <p class="text-[#64748b] text-[15px] mb-5">Finished 2014</p>

            <!-- Action Buttons -->
            <div class="flex flex-wrap gap-3">
                <button class="px-5 py-2.5 bg-[#2b3a8f] text-white font-semibold rounded-lg hover:bg-[#202c70] transition-colors focus:outline-none">
                    Add to Profile
                </button>
                <button class="px-5 py-2.5 border border-[#2b3a8f] text-[#2b3a8f] font-semibold rounded-lg hover:bg-[#2b3a8f]/5 transition-colors focus:outline-none">
                    Don't include
                </button>
            </div>
        </div>

    </div>
    <form action="{{ route('jobs_apply', $job->job_id) }}" method="POST" class="mt-6">
        @csrf
        <button type="submit" class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg shadow">
            Confirm & Submit Application
        </button>
    </form>
</x-app-layout>

