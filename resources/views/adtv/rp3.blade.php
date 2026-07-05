<x-app-layout>
<div class="w-full bg-white p-6 shadow-sm border border-gray-200 overflow-x-auto">
    <!-- Top Meta Info -->
    <div class="mb-4 text-xs font-mono tracking-wider text-gray-700 uppercase">
        NAME OF PESO: {{ $pesoName ?? 'VICTORIA S. BERIOSO' }}
    </div>

    <!-- Centered Report Titles -->
    <div class="text-center mb-6">
        <h2 class="text-base font-bold text-gray-900 tracking-wide uppercase">APPLICANTS REGISTERED</h2>
        <h3 class="text-sm font-semibold text-gray-700">For the Month of {{ $reportMonth ?? 'January 2026' }}</h3>
    </div>

    <!-- Spreadsheet Grid Table Wrapper -->
    <div class="overflow-x-auto border border-gray-400">
        <table class="min-w-full text-left border-collapse bg-white text-xs font-sans">
            <!-- Table Headers -->
            <thead>
                <tr class="border-b border-gray-400 text-gray-800 uppercase font-semibold">
                    <th class="p-2 border-r border-gray-400 text-center w-12">No.</th>
                    <th class="p-2 border-r border-gray-400 min-w-[200px]">Name of Applicant</th>
                    <th class="p-2 border-r border-gray-400 min-w-[180px]">Occupation/Skills</th>
                    <th class="p-2 border-r border-gray-400 w-16 text-center">Sex</th>
                    <th class="p-2 border-r border-gray-400 w-24 text-center">Birthdate</th>
                    <th class="p-2 border-r border-gray-400 w-20 text-center">Age</th>
                    <th class="p-2 border-r border-gray-400 w-28 text-center">Civil Status</th>
                    <th class="p-2 border-r border-gray-400 min-w-[180px]">Educational Attainment</th>
                    <th class="p-2 border-r border-gray-400 w-32 text-center">Yrs. of Work Experience</th>
                    <th class="p-2 border-r border-gray-400 min-w-[150px]">Employment Status</th>

                </tr>
            </thead>

            <!-- Table Body Data Loop -->
            <tbody class="divide-y divide-gray-300 text-gray-900 tracking-tight">
                @forelse($applicants ?? [] as $index => $applicant)
                    <tr class="hover:bg-gray-50">
                        <td class="p-1.5 border-r border-gray-300 text-center">{{ $index + 1 }}</td>
                        <td class="p-1.5 border-r border-gray-300 uppercase">
                            {{ trim(data_get($applicant, 'firstname', '') . ' ' . data_get($applicant, 'middlename', '') . ' ' . data_get($applicant, 'lastname', '')) }}
                        </td>
                        <td class="p-1.5 border-r border-gray-300 uppercase">{{ $applicant->skills }}</td>
                        <td class="p-1.5 border-r border-gray-300 text-center uppercase">{{ $applicant->sex }}</td>
                        <td class="p-1.5 border-r border-gray-300 text-center">{{ \Carbon\Carbon::parse($applicant->birthdate)->format('M. d, Y') }}</td>
                        <td class="p-1.5 border-r border-gray-300 text-center whitespace-nowrap text-[11px] text-gray-700">
                            {{-- Assuming helper logic calculates "25y 3mos" format --}}
                            {{ $applicant->age_formatted }}
                        </td>
                        <td class="p-1.5 border-r border-gray-300 text-center capitalize">{{ $applicant->civil_status }}</td>
                        <td class="p-1.5 border-r border-gray-300 uppercase">{{ $applicant->educational_attainment }}</td>
                        <td class="p-1.5 border-r border-gray-300 text-center"> years</td>
                        <td class="p-1.5 border-r border-gray-300 capitalize">{{ $applicant->employment_status }}</td>

                    </tr>
                @empty
                    <!-- Sample static row mock placeholder matching the first row of image_50a343.png -->
                    <tr>
                        <td class="p-1.5 border-r border-gray-300 text-center">1</td>
                        <td class="p-1.5 border-r border-gray-300 uppercase">LALUNA CLYDE, SAYRE</td>
                        <td class="p-1.5 border-r border-gray-300 uppercase">JANITORIAL SUPERVISOR</td>
                        <td class="p-1.5 border-r border-gray-300 text-center uppercase">MALE</td>
                        <td class="p-1.5 border-r border-gray-300 text-center">5/6/1978</td>
                        <td class="p-1.5 border-r border-gray-300 text-center whitespace-nowrap text-[11px] text-gray-700">47y 7mos</td>
                        <td class="p-1.5 border-r border-gray-300 text-center capitalize">Married</td>
                        <td class="p-1.5 border-r border-gray-300 uppercase">HIGH SCHOOL GRADUATE</td>
                        <td class="p-1.5 border-r border-gray-300 text-center">5 years</td>
                        <td class="p-1.5 border-r border-gray-300 capitalize">Employed (Others)</td>

                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</x-app-layout>
