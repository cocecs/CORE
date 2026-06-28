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
                List of users
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
            <div class="flex items-center space-x-3">
                <h2 class="text-lg font-bold text-gray-900 tracking-tight">System Administrators</h2>
                <span class="inline-flex items-center rounded-full bg-red-100 px-3 py-0.5 text-xs font-medium text-red-800">
                    Total: {{ $admins->count() }}
                </span>
            </div>
            <a href="{{ route('adtv_addUser') }}" class="inline-flex items-center rounded-md bg-blue-600 px-3 py-1.5 text-xs font-semibold text-white shadow-sm hover:bg-blue-500 transition-colors">
                <svg class="-ml-0.5 mr-1.5 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Add User
            </a>
        </div>
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 bg-white text-sm table-fixed">
                <thead class="bg-red-50 text-left font-medium text-red-900">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-xs uppercase tracking-wider w-20">No.</th>
                        <th scope="col" class="px-6 py-3 text-xs uppercase tracking-wider w-1/2">Admin Name</th>
                        <th scope="col" class="px-6 py-3 text-xs uppercase tracking-wider w-1/4">Email Address</th>
                        <th scope="col" class="px-6 py-3 text-xs uppercase tracking-wider text-right w-40">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-gray-900">
                    @forelse($admins as $admin)
                        <tr class="hover:bg-red-50/30 transition-colors">
                            <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-500">{{ $loop->iteration }}</td>
                            <td class="whitespace-nowrap px-6 py-4 font-semibold text-gray-900">
                                {{ $admin->firstname }} @if($admin->middlename){{ substr($admin->middlename, 0, 1) }}.@endif {{ $admin->lastname }} {{ $admin->ext }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-gray-600">{{ $admin->account?->email ?? 'N/A' }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-right">
                                <a href="#" class="inline-flex items-center rounded-md bg-red-600 px-4 py-1.5 text-xs font-semibold text-white shadow-sm hover:bg-red-500 transition-colors">
                                    Manage Admin
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="whitespace-nowrap px-6 py-8 text-center text-gray-500 italic bg-gray-50">No administrators registered.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


    <div>
        <div class="mb-4 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <h2 class="text-lg font-bold text-gray-900 tracking-tight">Registered Employers</h2>
                <span class="inline-flex items-center rounded-full bg-purple-100 px-3 py-0.5 text-xs font-medium text-purple-800">
                    Total: {{ $employers->count() }}
                </span>
            </div>
            <a href="{{ route('adtv_storeEmployer') }}" class="inline-flex items-center rounded-md bg-purple-600 px-3 py-1.5 text-xs font-semibold text-white shadow-sm hover:bg-purple-500 transition-colors">
                <svg class="-ml-0.5 mr-1.5 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Add Employer
            </a>
        </div>
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 bg-white text-sm table-fixed">
                <thead class="bg-purple-50 text-left font-medium text-purple-900">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-xs uppercase tracking-wider w-20">No.</th>
                        <th scope="col" class="px-6 py-3 text-xs uppercase tracking-wider w-1/2">Representative Name</th>
                        <th scope="col" class="px-6 py-3 text-xs uppercase tracking-wider w-1/4">Company Name</th>
                        <th scope="col" class="px-6 py-3 text-xs uppercase tracking-wider text-right w-40">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-gray-900">
                    @forelse($employers as $employer)
                        <tr class="hover:bg-purple-50/30 transition-colors">
                            <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-500">{{ $loop->iteration }}</td>
                            <td class="whitespace-nowrap px-6 py-4 font-semibold text-gray-900">
                                {{ $employer->representative_name }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-gray-600">{{ $employer->company_name }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-right">
                                <a href="#" class="inline-flex items-center rounded-md bg-purple-600 px-4 py-1.5 text-xs font-semibold text-white shadow-sm hover:bg-purple-500 transition-colors">
                                    View Company
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="whitespace-nowrap px-6 py-8 text-center text-gray-500 italic bg-gray-50">No employers registered.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


    <div>
        <div class="mb-4 flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-900 tracking-tight">Standard Users / Applicants</h2>
            <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-0.5 text-xs font-medium text-blue-800">
                Total: {{ $users->count() }}
            </span>
        </div>
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 bg-white text-sm table-fixed">
                <thead class="bg-blue-50 text-left font-medium text-blue-900">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-xs uppercase tracking-wider w-20">No.</th>
                        <th scope="col" class="px-6 py-3 text-xs uppercase tracking-wider w-1/2">User Name</th>
                        <th scope="col" class="px-6 py-3 text-xs uppercase tracking-wider w-1/4">Email Address</th>
                        <th scope="col" class="px-6 py-3 text-xs uppercase tracking-wider text-right w-40">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-gray-900">
                    @forelse($users as $user)
                        <tr class="hover:bg-blue-50/30 transition-colors">
                            <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-500">{{ $loop->iteration }}</td>
                            <td class="whitespace-nowrap px-6 py-4 font-semibold text-gray-900">
                                {{ $user->firstname }} @if($user->middlename){{ substr($user->middlename, 0, 1) }}.@endif {{ $user->lastname }} {{ $user->ext }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-gray-600">{{ $user->account?->email ?? 'N/A' }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-right">
                                <a href="#" class="inline-flex items-center rounded-md bg-blue-600 px-4 py-1.5 text-xs font-semibold text-white shadow-sm hover:bg-blue-500 transition-colors">
                                    View Profile
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="whitespace-nowrap px-6 py-8 text-center text-gray-500 italic bg-gray-50">No standard users registered.</td>
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
