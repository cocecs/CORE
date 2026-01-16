<x-app-layout>
<div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-700">Hello {{ $user->firstname }}! Let's complete your details.</h2>
    </div>

    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" class="mb-4 flex items-center justify-between p-4 text-green-700 bg-green-100 border border-green-200 rounded-lg" role="alert">
            <div class="flex items-center">
                <span class="font-bold mr-1">Success!</span> {{ session('success') }}
            </div>
            <button @click="show = false" type="button" class="text-green-700 hover:text-green-900">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
    @endif

    <div class="bg-white shadow-sm border border-gray-200 rounded-xl overflow-hidden">
        <div class="p-6">
            <form action="{{ route('details.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 gap-6">
                    {{-- <div>
                        <label for="idno" class="block text-sm font-medium text-gray-700 mb-1">ID #</label>
                        <input type="text" id="idno" name="idno" autofocus
                            value="{{ old('idno', $user->idno ?? '') }}"
                            class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500
                            @error('idno') border-red-500 @enderror"
                            readonly >
                        @error('idno')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- First Name -->
                    <div>
                        <label for="firstname" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                        <input type="text" id="firstname" name="firstname" autofocus
                            value="{{ old('firstname', $user->firstname ?? '') }}"
                            placeholder="Enter your Firstname"
                            class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('firstname') border-red-500 @enderror">
                        @error('firstname')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Middle Name -->
                    <div>
                        <label for="middlename" class="block text-sm font-medium text-gray-700 mb-1">Middle Name <span class="italic text-gray-400">(optional)</span></label>
                        <input type="text" id="middlename" name="middlename"
                            value="{{ old('middlename', $post->middlename ?? '') }}"
                            placeholder="Enter your Middle Name"
                            class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('middlename') border-red-500 @enderror">
                        @error('middlename')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label for="lastname" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                        <input type="text" id="lastname" name="lastname"
                            value="{{ old('lastname', $user->lastname ?? '') }}"
                            placeholder="Enter your Last Name"
                            class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('lastname') border-red-500 @enderror">
                        @error('lastname')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div> --}}

                    <!-- Date of Birth -->
                    <div>
                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                        <input type="date" id="date_of_birth" name="date_of_birth"
                            value="{{ old('date_of_birth', $post->date_of_birth ?? '') }}"
                            class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('date_of_birth') border-red-500 @enderror">
                        @error('date_of_birth')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Buttons -->
                <div class="mt-8 flex gap-3">
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                        Next
                    </button>
                    <button type="reset" class="px-6 py-2 bg-white text-gray-700 border border-gray-300 rounded-md font-semibold hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition">
                        Reset
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


</x-app-layout>

{{--
<x-app-layout>
<div class="container">
    <div class="row-justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="text-dark-emphasis m-0 mb-1">User Details</h2>
                </div>
            </div>
            @session('success')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong>{{ $value }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endsession
            <div class="card">
                <div class="card-body p-4">
                    <form action="{{ route('details.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" class="form-control @error('firstname') is-invalid @enderror"
                            id="firstname" name="firstname"
                            placeholder="Enter your Firstname"
                            autofocus
                            value="{{ old('firstname', $post->firstname ?? '') }}">
                            @error('firstname')
                                <span class="invalid-feedback">{{ $message }} </span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="middlename" class="form-label">Middle Name <i>(optional)</i></label>
                            <input type="text" class="form-control @error('middlename') is-invalid @enderror"
                            id="middlename" name="middlename"
                            placeholder="Enter your Middle Name"
                            value="{{ old('middlename', $post->middlename ?? '') }}">
                            @error('middlename')
                                <span class="invalid-feedback">{{ $message }} </span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" class="form-control @error('lastname') is-invalid @enderror"
                            id="lastname" name="lastname"
                            placeholder="Enter your Last Name"
                            value="{{ old('lastname', $post->lastname ?? '') }}">
                            @error('lastname')
                                <span class="invalid-feedback">{{ $message }} </span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                            id="date_of_birth" name="date_of_birth"
                            placeholder="Enter your Date of Birth"
                            value="{{ old('date_of_birth', $post->date_of_birth ?? '') }}">
                            @error('date_of_birth')
                                <span class="invalid-feedback">{{ $message }} </span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <div x-data="{
                                selectedProvince: '',
                                allData: @js(config('locations.provinces')),
                                get towns() {
                                    return this.selectedProvince ? this.allData[this.selectedProvince].towns : {};
                                }
                            }" class="space-y-4">

                                <div class="mb-4">
                                    <label class="block font-bold">Province</label>
                                    <select name="province" x-model="selectedProvince" class="form-control @error('province') is-invalid @enderror">
                                        <option value="">-- Select Province --</option>
                                        <template x-for="(data, key) in allData" :key="key">
                                            <option :value="key" x-text="data.name"></option>
                                        </template>
                                    </select>
                                    @error('province')
                                        <span class="invalid-feedback">{{ $message }} </span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="block font-bold">Town</label>
                                    <select name="town" class="form-control @error('town') is-invalid @enderror" :disabled="!selectedProvince">
                                        <option value="">-- Select Town --</option>
                                        <template x-for="(name, zip) in towns" :key="zip">
                                            <option :value="zip" x-text="name"></option>
                                        </template>
                                    </select>
                                    @error('town')
                                        <span class="invalid-feedback">{{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
                        </div>

                        <div class="mb-4">
                            <label for="address" class="form-label">Address <i>(bldg #, st.)</i></label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror"
                            id="address" name="address"
                            placeholder="Enter your Address"
                            value="{{ old('address', $post->address ?? '') }}">
                            @error('address')
                                <span class="invalid-feedback">{{ $message }} </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="tel" class="form-label">Tel. # <i>(optional)</i></label>
                            <input type="text" class="form-control @error('tel') is-invalid @enderror"
                            id="tel" name="tel_no"
                            placeholder="Enter your Tel. #"
                            value="{{ old('tel_no', $post->tel_no ?? '') }}">
                            @error('tel_no')
                                <span class="invalid-feedback">{{ $message }} </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="mobile" class="form-label">Mobile # <i>(optional)</i></label>
                            <input type="text" class="form-control @error('mobile') is-invalid @enderror"
                            id="mobile" name="mobile_no"
                            placeholder="Enter your Mobile #"
                            value="{{ old('mobile_no', $post->mobile_no ?? '') }}">
                            @error('mobile_no')
                                <span class="invalid-feedback">{{ $message }} </span>
                            @enderror
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Next</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>

</x-app-layout> --}}
