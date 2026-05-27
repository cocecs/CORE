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
                Good day! Welcome to CORE.
            </h2>
        @endif
    </div>
</div>
<form action="" method="POST">
@csrf
<div class="flex items-center justify-center">
  <div class="mx-auto w-full max-w-md px-6">
    <div class="flex flex-col gap-4">
        <div class="w-full max-w-xl rounded-md bg-white p-5 text-gray-600 ring-2 ring-transparent transition-all hover:shadow peer-checked:text-sky-600 peer-checked:ring-blue-400 peer-checked:ring-offset-2">
            <label for="firstname" class="block text-sm font-medium text-gray-700 mb-1">Company Name <span class="text-red-700">*</span></label>
                <input type="text" name="firstname" id="firstname"
                    class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('firstname') border-red-500 @enderror">
            </label>
            <label for="middlename" class="block text-sm font-medium text-gray-700 mb-1 mt-3">TIN</label>
                <input type="text" id="middlename" name="middlename"
                    class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
            </label>

        </div>
        <div class="w-full max-w-xl rounded-md bg-white p-5 text-gray-600 ring-2 ring-transparent transition-all hover:shadow peer-checked:text-sky-600 peer-checked:ring-blue-400 peer-checked:ring-offset-2">
            <div x-data="{
                selectedProvince: '',
                selectedTown: '',
                allData: @js(config('locations.provinces')),

                get towns() {
                    return this.selectedProvince ? this.allData[this.selectedProvince].towns : {};
                },

                get barangays() {
                    if (this.selectedProvince && this.selectedTown) {
                        return this.towns[this.selectedTown].barangays || [];
                    }
                    return [];
                }
            }" class="space-y-6">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Province <span class="text-red-700">*</span></label>
                    <select name="province" x-model="selectedProvince" @change="selectedTown = ''"
                        class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                        @error('province') border-red-500 @enderror>
                        <option value=""></option>
                        <template x-for="(data, key) in allData" :key="key">
                            <option :value="key" x-text="data.name"></option>
                        </template>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Town <span class="text-red-700">*</span></label>
                    <select name="town" x-model="selectedTown" :disabled="!selectedProvince"
                        class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 disabled:bg-gray-100"
                        @error('town') border-red-500 @enderror>
                        <option value=""></option>
                        <template x-for="(data, zip) in towns" :key="zip">
                            <option :value="zip" x-text="data.name"></option>
                        </template>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Barangay <span class="text-red-700">*</span></label>
                    <select name="brgy" :disabled="!selectedTown"
                        class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 disabled:bg-gray-100"
                        @error('brgy') border-red-500 @enderror>
                        <option value=""></option>
                        <template x-for="brgy in barangays" :key="brgy">
                            <option :value="brgy" x-text="brgy"></option>
                        </template>
                    </select>
                </div>
            </div>

            <!-- Address -->
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address <span class="italic text-gray-400">(Bldg./House#/Street/Village)</span></label>
                <input type="text" id="address" name="address"
                    value="{{ old('address', $post->address ?? '') }}"
                    placeholder="Enter your Address"
                    class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('address') border-red-500 @enderror">

            </div>
        </div>
    </div>
  </div>
</div>
<div class="flex items-center justify-center mb-6">
    <div class="mx-auto max-w-6xl px-12">
        <div class="mt-8 flex gap-3">
            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                Next
            </button>
            <button type="reset" class="px-6 py-2 bg-white text-gray-700 border border-gray-300 rounded-md font-semibold hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition">
                Reset
            </button>
        </div>
    </div>
</div>
</form>

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
