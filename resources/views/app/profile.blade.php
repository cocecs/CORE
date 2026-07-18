<x-app-layout>
<!-- Root Element with fully unified Alpine.js state -->
<div x-data="{
        openModal: false,
        openEducationModal: false,
        openSummaryModal: false,
        modalType: 'add',
        educationForm: {
            degree: '',
            school: '',
            year: '',
            skills_raw: ''
        },
        summaryForm: {
            summary: ''
        },
        openEditModal(degree, school, year, skills) {
            this.modalType = 'edit';
            this.educationForm = { degree, school, year, skills_raw: skills };
            this.openEducationModal = true;
        },
        openAddModal() {
            this.modalType = 'add';
            this.educationForm = { degree: '', school: '', year: '', skills_raw: '' };
            this.openEducationModal = true;
        },
        openEditSummary(existingSummary) {
            this.summaryForm.summary = existingSummary;
            this.openSummaryModal = true;
        }
     }"
     @keydown.escape.window="openModal = false; openEducationModal = false; openSummaryModal = false;"
     class="max-w-4xl mx-auto my-8 p-6 bg-slate-50 text-slate-800 antialiased font-sans space-y-6">
    <!-- Information Banner: Importance of Profile Completion -->
    <div class="bg-gradient-to-r from-indigo-50 to-blue-50 border border-indigo-100/80 rounded-2xl p-5 flex gap-4 shadow-xs">
        <div class="p-2.5 bg-indigo-500 text-white rounded-xl h-fit shrink-0 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 111.063.852l-.708 2.836a.75.75 0 001.063.852l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
            </svg>
        </div>
        <div class="space-y-1">
            <h2 class="text-base font-bold text-indigo-950">Complete Your Profile to Get Discovered</h2>
            <p class="text-sm text-indigo-900/80 leading-relaxed">
                A complete profile is your key to unlocking opportunities! Employers use your contact info, location details, education history, and skills to match you with ideal livelihood and job placements. Please make sure to fill out your profile completely to increase your chances of being noticed and reached.
            </p>
        </div>
    </div>
    <!-- Unified Profile Section Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <!-- Section Header -->
        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
            <div>
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Profile Information</span>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight mt-1">
                    {{ trim(($user->firstname ?? '') . ' ' . ($user->middlename ?? '') . ' ' . ($user->lastname ?? '') . ' ' . ($user->ext ?? '')) }}
                </h1>
            </div>

            <button @click="openModal = true" class="flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-indigo-600 bg-indigo-50 hover:bg-indigo-100/80 active:bg-indigo-100 rounded-xl transition-all shadow-sm" title="Edit Profile">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                </svg>
                <span>Edit Profile</span>
            </button>
        </div>

        <!-- Details Grid -->
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Left Side: Contact & Location Info -->
            <div class="space-y-4">
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Contact & Location</h3>
                <div class="space-y-3">
                    @if($user->barangay || $user->town || $user->province)
                        <div class="flex items-start gap-3 text-sm text-slate-600">
                            <div class="p-1 bg-slate-50 rounded-lg text-slate-400 mt-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Address</p>
                                <p class="font-medium text-slate-700 mt-0.5">
                                    {{ implode(', ', array_filter([$user->barangay, $user->town, $user->province])) }}
                                </p>
                            </div>
                        </div>
                    @endif

                    @if($user->email)
                        <div class="flex items-start gap-3 text-sm text-slate-600">
                            <div class="p-1 bg-slate-50 rounded-lg text-slate-400 mt-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0l-7.5-4.615a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Email Address</p>
                                <a href="mailto:{{ $user->email }}" class="hover:underline text-indigo-600 font-semibold mt-0.5 inline-block">{{ $user->email }}</a>
                            </div>
                        </div>
                    @endif

                    <!-- Mobile Number Display -->
                    <div class="flex items-start gap-3 text-sm text-slate-600">
                        <div class="p-1 bg-slate-50 rounded-lg text-slate-400 mt-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Mobile Number</p>
                            <p class="font-medium text-slate-700 mt-0.5">{{ $user->mobile_no ?? 'Not Specified' }}</p>
                        </div>
                    </div>

                    <!-- Telephone Number Display -->
                    <div class="flex items-start gap-3 text-sm text-slate-600">
                        <div class="p-1 bg-slate-50 rounded-lg text-slate-400 mt-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.387a12.035 12.035 0 0 1-7.108-7.108c-.145-.44.02-.927.396-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Telephone Number</p>
                            <p class="font-medium text-slate-700 mt-0.5">{{ $user->telephone_no ?? 'Not Specified' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Personal Identity Details -->
            <div class="space-y-4">
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Personal Details</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-slate-50 rounded-xl text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Sex</p>
                            <p class="text-sm font-semibold text-slate-800">{{ $user->sex ?? 'Not Specified' }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-slate-50 rounded-xl text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Civil Status</p>
                            <p class="text-sm font-semibold text-slate-800">{{ $user->civil_status ?? 'Not Specified' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Combined Education & Skills Section Card -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 space-y-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-3xl font-bold tracking-tight text-[#1e2d56]">Education & Skills</h2>
                <p class="text-sm text-slate-400 mt-1">Your academic qualifications and the skills associated with them.</p>
            </div>
            <button @click="openAddModal()" class="flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-white bg-[#2b3a8f] hover:bg-[#202c70] active:bg-[#1a245c] rounded-xl transition-all shadow-sm focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>Add Details</span>
            </button>
        </div>

        <!-- Course & Skills Card -->
        <div class="space-y-6">
            @php
                // 1. Extract and organize completed courses purely from the Educationals record
                $completedCourses = [];
                if ($education) {
                    if (!empty($education->vocational_course)) {
                        $completedCourses['Vocational Course'] = $education->vocational_course;
                    }

                    $degree = $education->degree_course ?? $education->course_degree ?? null;
                    if (!empty($degree)) {
                        $completedCourses['Degree Course'] = $degree;
                    }

                    $postgrad = $education->postgrad_degree_course ?? $education->postgrad_course_degree ?? null;
                    if (!empty($postgrad)) {
                        $completedCourses['Postgraduate Degree'] = $postgrad;
                    }

                    $doctoral = $education->doctoral_course ?? $education->doctoral_course_degree ?? null;
                    if (!empty($doctoral)) {
                        $completedCourses['Doctoral Degree'] = $doctoral;
                    }
                }

                // 2. Fetch skills dynamically based on populated courses in Educationals
                $skillsArray = [];
                $rawSkillsString = '';

                if ($education) {
                    if (!empty($education->vocational_course)) {
                        $rawSkillsString = $education->vocational_skills;
                    } elseif (!empty($education->course_degree) || !empty($education->degree_course)) {
                        $rawSkillsString = $education->bachelor_skills;
                    } elseif (!empty($education->postgrad_course_degree) || !empty($education->postgrad_degree_course)) {
                        $rawSkillsString = $education->masters_skills;
                    } elseif (!empty($education->doctoral_course_degree) || !empty($education->doctoral_course)) {
                        $rawSkillsString = $education->doctoral_skills;
                    }

                    // Format the skills into an array for tags rendering
                    if (!empty($rawSkillsString)) {
                        if (is_array($rawSkillsString)) {
                            $skillsArray = $rawSkillsString;
                            $rawSkillsString = implode(', ', $skillsArray);
                        } else {
                            $skillsArray = array_filter(array_map('trim', explode(',', $rawSkillsString)));
                        }
                    }
                }
            @endphp

            @if($education && (!empty($completedCourses) || !empty($skillsArray)))
                <div class="bg-white border border-[#e2e8f0] rounded-2xl p-6 relative shadow-xs">

                    <!-- Trigger edit modal, passing only the mapped skills to Alpine.js -->
                    <button @click="openEditModal('{{ addslashes($rawSkillsString ?? '') }}')"
                            class="absolute top-6 right-6 text-[#475569] hover:text-[#1e2d56] transition-colors focus:outline-none"
                            aria-label="Edit entry">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                    </button>

                    <h3 class="text-xl font-bold text-[#1e2d56] mb-4">Academic Profile</h3>

                    <!-- Loop & Display Courses found in Educationals -->
                    @if(!empty($completedCourses))
                        <div class="border-t border-slate-100 py-4 space-y-3">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400">Courses / Degrees Obtained</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach($completedCourses as $levelName => $courseName)
                                    <div class="bg-slate-50 border border-slate-100 rounded-xl p-3 flex flex-col justify-center">
                                        <span class="text-[10px] font-bold uppercase tracking-wider text-[#2b3a8f] mb-0.5">
                                            {{ $levelName }}
                                        </span>
                                        <span class="text-sm font-semibold text-slate-700">
                                            {{ $courseName }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Nested Skills Tags -->
                    @if(!empty($skillsArray))
                        <div class="border-t border-slate-100 pt-4">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Skills Acquired</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach($skillsArray as $skill)
                                    <span class="px-3.5 py-1.5 bg-[#f4f6f9] text-[#2c3e50] rounded-full text-xs font-medium transition hover:bg-[#eaf0f6] cursor-pointer">
                                        {{ $skill }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <!-- Fallback empty state -->
                <div class="text-center py-8 border border-dashed border-slate-200 rounded-2xl">
                    <p class="text-sm text-slate-400">No courses or skills records found.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Personal Summary Section Card -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 space-y-4">
        <h2 class="text-xl font-bold text-slate-900 tracking-tight">Personal summary</h2>
        @if(!empty($user->summary))
            <p class="text-sm text-slate-600 leading-relaxed">{{ $user->summary }}</p>
            <button @click="openEditSummary('{{ addslashes($user->summary) }}')" class="px-5 py-2 text-sm font-semibold text-indigo-700 bg-white border-2 border-indigo-700 rounded-xl hover:bg-indigo-50/50 active:bg-indigo-50 transition-colors">
                Edit summary
            </button>
        @else
            <p class="text-sm text-slate-600 leading-relaxed">
                Add a personal summary to your profile as a way to introduce who you are.
            </p>
            <button @click="openEditSummary('')" class="px-5 py-2 text-sm font-semibold text-indigo-700 bg-white border-2 border-indigo-700 rounded-xl hover:bg-indigo-50/50 active:bg-indigo-50 transition-colors">
                Add summary
            </button>
        @endif
    </div>

    <!-- ========================================================================= -->
    <!-- PROFILE EDIT MODAL -->
    <!-- ========================================================================= -->
    <div x-show="openModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;"
         x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm" @click="openModal = false"></div>
        <div class="flex min-h-full items-center justify-center p-4 text-center">
            <div x-show="openModal"
                 x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all my-8 w-full max-w-2xl border border-slate-100">
                <div class="px-6 py-4 flex justify-between items-center border-b border-slate-100">
                    <h3 class="text-xl font-bold text-slate-900 tracking-tight">Edit Profile Details</h3>
                    <button @click="openModal = false" class="text-slate-400 hover:text-slate-600 rounded-lg p-1.5 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                <form action="{{ route('profile.update') }}" method="POST" class="space-y-6 p-6">
                    @csrf @method('PUT')
                    <!-- Name Grid -->
                    <div class="space-y-3">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-indigo-600">Full Name</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                            <div>
                                <label for="firstname" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">First Name</label>
                                <input type="text" name="firstname" id="firstname" value="{{ $user->firstname }}" class="w-full rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800 focus:border-indigo-500 focus:bg-white focus:ring-1 focus:ring-indigo-500 transition-all p-2.5">
                            </div>
                            <div>
                                <label for="middlename" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Middle Name</label>
                                <input type="text" name="middlename" id="middlename" value="{{ $user->middlename }}" class="w-full rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800 focus:border-indigo-500 focus:bg-white focus:ring-1 focus:ring-indigo-500 transition-all p-2.5">
                            </div>
                            <div>
                                <label for="lastname" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Last Name</label>
                                <input type="text" name="lastname" id="lastname" value="{{ $user->lastname }}" class="w-full rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800 focus:border-indigo-500 focus:bg-white focus:ring-1 focus:ring-indigo-500 transition-all p-2.5">
                            </div>
                            <div>
                                <label for="ext" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Suffix</label>
                                <input type="text" name="ext" id="ext" value="{{ $user->ext }}" class="w-full rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800 focus:border-indigo-500 focus:bg-white focus:ring-1 focus:ring-indigo-500 transition-all p-2.5">
                            </div>
                        </div>
                    </div>

                    <!-- Contact Details -->
                    <div class="space-y-3">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-indigo-600">Contact Details</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Email Address</label>
                                <input type="email" name="email" id="email" value="{{ $user->email }}" class="w-full rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800 focus:border-indigo-500 focus:bg-white focus:ring-1 focus:ring-indigo-500 transition-all p-2.5">
                            </div>
                            <div>
                                <label for="mobile_no" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Mobile No.</label>
                                <input type="text" name="mobile_no" id="mobile_no" value="{{ $user->mobile_no }}" placeholder="e.g. 09171234567" class="w-full rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800 focus:border-indigo-500 focus:bg-white focus:ring-1 focus:ring-indigo-500 transition-all p-2.5">
                            </div>
                            <div>
                                <label for="telephone_no" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Telephone No.</label>
                                <input type="text" name="telephone_no" id="telephone_no" value="{{ $user->telephone_no }}" placeholder="e.g. (02) 8123-4567" class="w-full rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800 focus:border-indigo-500 focus:bg-white focus:ring-1 focus:ring-indigo-500 transition-all p-2.5">
                            </div>
                        </div>
                    </div>

                    <!-- Demographics Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="sex" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Sex</label>
                            <select name="sex" id="sex" class="w-full rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800 focus:border-indigo-500 focus:bg-white focus:ring-1 focus:ring-indigo-500 transition-all p-2.5">
                                <option value="" {{ !$user->sex ? 'selected' : '' }}>Select Sex</option>
                                <option value="Male" {{ $user->sex === 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ $user->sex === 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                        <div>
                            <label for="civil_status" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Civil Status</label>
                            <select name="civil_status" id="civil_status" class="w-full rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800 focus:border-indigo-500 focus:bg-white focus:ring-1 focus:ring-indigo-500 transition-all p-2.5">
                                <option value="" {{ !$user->civil_status ? 'selected' : '' }}>Select Status</option>
                                <option value="Single" {{ $user->civil_status === 'Single' ? 'selected' : '' }}>Single</option>
                                <option value="Married" {{ $user->civil_status === 'Married' ? 'selected' : '' }}>Married</option>
                                <option value="Widowed" {{ $user->civil_status === 'Widowed' ? 'selected' : '' }}>Widowed</option>
                                <option value="Divorced" {{ $user->civil_status === 'Divorced' ? 'selected' : '' }}>Divorced</option>
                            </select>
                        </div>
                    </div>

                    <!-- Location Grid -->
                    <div class="space-y-3">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-indigo-600">Location Details</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label for="barangay" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Barangay</label>
                                <input type="text" name="barangay" id="barangay" value="{{ $user->barangay }}" class="w-full rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800 focus:border-indigo-500 focus:bg-white focus:ring-1 focus:ring-indigo-500 transition-all p-2.5">
                            </div>
                            <div>
                                <label for="town" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Town / City</label>
                                <input type="text" name="town" id="town" value="{{ $user->town }}" class="w-full rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800 focus:border-indigo-500 focus:bg-white focus:ring-1 focus:ring-indigo-500 transition-all p-2.5">
                            </div>
                            <div>
                                <label for="province" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Province</label>
                                <input type="text" name="province" id="province" value="{{ $user->province }}" class="w-full rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800 focus:border-indigo-500 focus:bg-white focus:ring-1 focus:ring-indigo-500 transition-all p-2.5">
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 mt-6 border-t border-slate-100">
                        <button type="button" @click="openModal = false" class="px-4 py-2 text-sm font-semibold text-slate-600 border border-slate-200 rounded-xl hover:bg-slate-50 active:bg-slate-100 transition-colors">Cancel</button>
                        <button type="submit" class="px-5 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-colors shadow-sm">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- COMBINED EDUCATION & SKILLS MODAL -->
    <!-- ========================================================================= -->
    <div x-show="openEducationModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm" @click="openEducationModal = false"></div>
        <div class="flex min-h-full items-center justify-center p-4 text-center">
            <div x-show="openEducationModal"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all my-8 w-full max-w-lg border border-slate-100">
                <div class="px-6 py-4 flex justify-between items-center border-b border-slate-100">
                    <h3 class="text-xl font-bold text-[#1e2d56] tracking-tight" x-text="modalType === 'edit' ? 'Edit Course & Skills' : 'Add Course & Skills'"></h3>
                    <button @click="openEducationModal = false" class="text-slate-400 hover:text-slate-600 rounded-lg p-1.5 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                <form action="#" method="POST" class="space-y-4 p-6">
                    @csrf
                    <template x-if="modalType === 'edit'">
                        <input type="hidden" name="_method" value="PUT">
                    </template>
                    <div>
                        <label for="degree" class="block text-xs font-semibold uppercase tracking-wider text-[#64748b] mb-1">Degree / Course</label>
                        <input type="text" name="degree" id="degree" x-model="educationForm.degree" required
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800 focus:border-[#2b3a8f] focus:bg-white focus:ring-1 focus:ring-[#2b3a8f] transition-all p-2.5">
                    </div>
                    <div>
                        <label for="school" class="block text-xs font-semibold uppercase tracking-wider text-[#64748b] mb-1">School / University</label>
                        <input type="text" name="school" id="school" x-model="educationForm.school" required
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800 focus:border-[#2b3a8f] focus:bg-white focus:ring-1 focus:ring-[#2b3a8f] transition-all p-2.5">
                    </div>
                    <div>
                        <label for="year" class="block text-xs font-semibold uppercase tracking-wider text-[#64748b] mb-1">Year Completed</label>
                        <input type="text" name="year" id="year" x-model="educationForm.year" placeholder="e.g. 2014" required
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800 focus:border-[#2b3a8f] focus:bg-white focus:ring-1 focus:ring-[#2b3a8f] transition-all p-2.5">
                    </div>
                    <div>
                        <label for="course_skills" class="block text-xs font-semibold uppercase tracking-wider text-[#64748b] mb-1">Skills Gained in this Course (Comma Separated)</label>
                        <textarea name="course_skills" id="course_skills" x-model="educationForm.skills_raw" rows="3" placeholder="e.g. Graphic Design, Photography, Web Programming"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800 focus:border-[#2b3a8f] focus:bg-white focus:ring-1 focus:ring-[#2b3a8f] transition-all p-2.5 resize-none"></textarea>
                        <p class="text-xs text-slate-400 mt-1.5">Separate entries with commas. For instance: <em>Laravel, Tailwind CSS, Blade</em>.</p>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 mt-6 border-t border-slate-100">
                        <button type="button" @click="openEducationModal = false" class="px-4 py-2 text-sm font-semibold text-slate-600 border border-slate-200 rounded-xl hover:bg-slate-50 active:bg-slate-100 transition-colors">Cancel</button>
                        <button type="submit" class="px-5 py-2 text-sm font-semibold text-white bg-[#2b3a8f] rounded-xl hover:bg-[#202c70] transition-colors shadow-sm">Save Course & Skills</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- PERSONAL SUMMARY MODAL -->
    <!-- ========================================================================= -->
    <div x-show="openSummaryModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm" @click="openSummaryModal = false"></div>
        <div class="flex min-h-full items-center justify-center p-4 text-center">
            <div x-show="openSummaryModal"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all my-8 w-full max-w-xl border border-slate-100">
                <div class="px-6 py-4 flex justify-between items-center border-b border-slate-100">
                    <h3 class="text-xl font-bold text-slate-900 tracking-tight">Edit Personal Summary</h3>
                    <button @click="openSummaryModal = false" class="text-slate-400 hover:text-slate-600 rounded-lg p-1.5 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                <form action="#" method="POST" class="space-y-4 p-6">
                    @csrf @method('PUT')
                    <div>
                        <label for="summary" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Introduction / Summary</label>
                        <textarea name="summary" id="summary" x-model="summaryForm.summary" rows="5" required placeholder="Introduce yourself, your academic experience, or career goals..."
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800 focus:border-indigo-500 focus:bg-white focus:ring-1 focus:ring-indigo-500 transition-all p-2.5 resize-y"></textarea>
                    </div>
                    <div class="flex items-center justify-end gap-3 pt-4 mt-6 border-t border-slate-100">
                        <button type="button" @click="openSummaryModal = false" class="px-4 py-2 text-sm font-semibold text-slate-600 border border-slate-200 rounded-xl hover:bg-slate-50 active:bg-slate-100 transition-colors">Cancel</button>
                        <button type="submit" class="px-5 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-colors shadow-sm">Save Summary</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
