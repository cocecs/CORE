<x-app-layout>
<div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-700">Great {{ $user->firstname }}! Where now in the Stage 2. Let's identify your level of education.</h2>
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
            <form action="{{ route('background.store') }}" method="POST">
                @csrf
                <div class="flex items-center justify-center mb-6">
                    <div class="mx-auto max-w-6xl px-12">
                        <div class="grid grid-cols-1 gap-6">
                            <div class="flex flex-wrap gap-3">
                                <label class="cursor-pointer">
                                    <input type="radio" class="peer sr-only" name="educational_level" value="elementary"/>
                                    <div class="w-60 max-w-xl rounded-md bg-white p-5 text-gray-600 ring-2 ring-transparent transition-all hover:shadow peer-checked:text-sky-600 peer-checked:ring-blue-400 peer-checked:ring-offset-2">
                                    <div class="flex flex-col gap-1">
                                        <div class="flex items-center justify-between">
                                        <p class="text-sm font-semibold uppercase text-gray-500">Elementary</p>
                                        <div>
                                            <svg width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m10.6 13.8l-2.175-2.175q-.275-.275-.675-.275t-.7.3q-.275.275-.275.7q0 .425.275.7L9.9 15.9q.275.275.7.275q.425 0 .7-.275l5.675-5.675q.275-.275.275-.675t-.3-.7q-.275-.275-.7-.275q-.425 0-.7.275ZM12 22q-2.075 0-3.9-.788q-1.825-.787-3.175-2.137q-1.35-1.35-2.137-3.175Q2 14.075 2 12t.788-3.9q.787-1.825 2.137-3.175q1.35-1.35 3.175-2.138Q9.925 2 12 2t3.9.787q1.825.788 3.175 2.138q1.35 1.35 2.137 3.175Q22 9.925 22 12t-.788 3.9q-.787 1.825-2.137 3.175q-1.35 1.35-3.175 2.137Q14.075 22 12 22Z" /></svg>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" class="peer sr-only" name="educational_level" value="highschool" />
                                    <div class="w-60 max-w-xl rounded-md bg-white p-5 text-gray-600 ring-2 ring-transparent transition-all hover:shadow peer-checked:text-sky-600 peer-checked:ring-blue-400 peer-checked:ring-offset-2">
                                    <div class="flex flex-col gap-1">
                                        <div class="flex items-center justify-between">
                                        <p class="text-sm font-semibold uppercase text-gray-500">High School</p>
                                        <div>
                                            <svg width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m10.6 13.8l-2.175-2.175q-.275-.275-.675-.275t-.7.3q-.275.275-.275.7q0 .425.275.7L9.9 15.9q.275.275.7.275q.425 0 .7-.275l5.675-5.675q.275-.275.275-.675t-.3-.7q-.275-.275-.7-.275q-.425 0-.7.275ZM12 22q-2.075 0-3.9-.788q-1.825-.787-3.175-2.137q-1.35-1.35-2.137-3.175Q2 14.075 2 12t.788-3.9q.787-1.825 2.137-3.175q1.35-1.35 3.175-2.138Q9.925 2 12 2t3.9.787q1.825.788 3.175 2.138q1.35 1.35 2.137 3.175Q22 9.925 22 12t-.788 3.9q-.787 1.825-2.137 3.175q-1.35 1.35-3.175 2.137Q14.075 22 12 22Z" /></svg>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" class="peer sr-only" name="educational_level" value="vocational"/>
                                    <div class="w-60 max-w-xl rounded-md bg-white p-5 text-gray-600 ring-2 ring-transparent transition-all hover:shadow peer-checked:text-sky-600 peer-checked:ring-blue-400 peer-checked:ring-offset-2">
                                    <div class="flex flex-col gap-1">
                                        <div class="flex items-center justify-between">
                                        <p class="text-sm font-semibold uppercase text-gray-500">Vocational</p>
                                        <div>
                                            <svg width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m10.6 13.8l-2.175-2.175q-.275-.275-.675-.275t-.7.3q-.275.275-.275.7q0 .425.275.7L9.9 15.9q.275.275.7.275q.425 0 .7-.275l5.675-5.675q.275-.275.275-.675t-.3-.7q-.275-.275-.7-.275q-.425 0-.7.275ZM12 22q-2.075 0-3.9-.788q-1.825-.787-3.175-2.137q-1.35-1.35-2.137-3.175Q2 14.075 2 12t.788-3.9q.787-1.825 2.137-3.175q1.35-1.35 3.175-2.138Q9.925 2 12 2t3.9.787q1.825.788 3.175 2.138q1.35 1.35 2.137 3.175Q22 9.925 22 12t-.788 3.9q-.787 1.825-2.137 3.175q-1.35 1.35-3.175 2.137Q14.075 22 12 22Z" /></svg>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" class="peer sr-only" name="educational_level" value="asso_degree" />
                                    <div class="w-60 max-w-xl rounded-md bg-white p-5 text-gray-600 ring-2 ring-transparent transition-all hover:shadow peer-checked:text-sky-600 peer-checked:ring-blue-400 peer-checked:ring-offset-2">
                                    <div class="flex flex-col gap-1">
                                        <div class="flex items-center justify-between">
                                        <p class="text-sm font-semibold uppercase text-gray-500">Associate Degree</p>
                                        <div>
                                            <svg width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m10.6 13.8l-2.175-2.175q-.275-.275-.675-.275t-.7.3q-.275.275-.275.7q0 .425.275.7L9.9 15.9q.275.275.7.275q.425 0 .7-.275l5.675-5.675q.275-.275.275-.675t-.3-.7q-.275-.275-.7-.275q-.425 0-.7.275ZM12 22q-2.075 0-3.9-.788q-1.825-.787-3.175-2.137q-1.35-1.35-2.137-3.175Q2 14.075 2 12t.788-3.9q.787-1.825 2.137-3.175q1.35-1.35 3.175-2.138Q9.925 2 12 2t3.9.787q1.825.788 3.175 2.138q1.35 1.35 2.137 3.175Q22 9.925 22 12t-.788 3.9q-.787 1.825-2.137 3.175q-1.35 1.35-3.175 2.137Q14.075 22 12 22Z" /></svg>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" class="peer sr-only" name="educational_level" value="bachelor"/>
                                    <div class="w-60 max-w-xl rounded-md bg-white p-5 text-gray-600 ring-2 ring-transparent transition-all hover:shadow peer-checked:text-sky-600 peer-checked:ring-blue-400 peer-checked:ring-offset-2">
                                    <div class="flex flex-col gap-1">
                                        <div class="flex items-center justify-between">
                                        <p class="text-sm font-semibold uppercase text-gray-500">Bachelor's Degree</p>
                                        <div>
                                            <svg width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m10.6 13.8l-2.175-2.175q-.275-.275-.675-.275t-.7.3q-.275.275-.275.7q0 .425.275.7L9.9 15.9q.275.275.7.275q.425 0 .7-.275l5.675-5.675q.275-.275.275-.675t-.3-.7q-.275-.275-.7-.275q-.425 0-.7.275ZM12 22q-2.075 0-3.9-.788q-1.825-.787-3.175-2.137q-1.35-1.35-2.137-3.175Q2 14.075 2 12t.788-3.9q.787-1.825 2.137-3.175q1.35-1.35 3.175-2.138Q9.925 2 12 2t3.9.787q1.825.788 3.175 2.138q1.35 1.35 2.137 3.175Q22 9.925 22 12t-.788 3.9q-.787 1.825-2.137 3.175q-1.35 1.35-3.175 2.137Q14.075 22 12 22Z" /></svg>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" class="peer sr-only" name="educational_level" value="master" />
                                    <div class="w-60 max-w-xl rounded-md bg-white p-5 text-gray-600 ring-2 ring-transparent transition-all hover:shadow peer-checked:text-sky-600 peer-checked:ring-blue-400 peer-checked:ring-offset-2">
                                    <div class="flex flex-col gap-1">
                                        <div class="flex items-center justify-between">
                                        <p class="text-sm font-semibold uppercase text-gray-500">Master's Degree</p>
                                        <div>
                                            <svg width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m10.6 13.8l-2.175-2.175q-.275-.275-.675-.275t-.7.3q-.275.275-.275.7q0 .425.275.7L9.9 15.9q.275.275.7.275q.425 0 .7-.275l5.675-5.675q.275-.275.275-.675t-.3-.7q-.275-.275-.7-.275q-.425 0-.7.275ZM12 22q-2.075 0-3.9-.788q-1.825-.787-3.175-2.137q-1.35-1.35-2.137-3.175Q2 14.075 2 12t.788-3.9q.787-1.825 2.137-3.175q1.35-1.35 3.175-2.138Q9.925 2 12 2t3.9.787q1.825.788 3.175 2.138q1.35 1.35 2.137 3.175Q22 9.925 22 12t-.788 3.9q-.787 1.825-2.137 3.175q-1.35 1.35-3.175 2.137Q14.075 22 12 22Z" /></svg>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" class="peer sr-only" name="educational_level    " value="doctorate"/>
                                    <div class="w-60 max-w-xl rounded-md bg-white p-5 text-gray-600 ring-2 ring-transparent transition-all hover:shadow peer-checked:text-sky-600 peer-checked:ring-blue-400 peer-checked:ring-offset-2">
                                    <div class="flex flex-col gap-1">
                                        <div class="flex items-center justify-between">
                                        <p class="text-sm font-semibold uppercase text-gray-500">Doctorate</p>
                                        <div>
                                            <svg width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m10.6 13.8l-2.175-2.175q-.275-.275-.675-.275t-.7.3q-.275.275-.275.7q0 .425.275.7L9.9 15.9q.275.275.7.275q.425 0 .7-.275l5.675-5.675q.275-.275.275-.675t-.3-.7q-.275-.275-.7-.275q-.425 0-.7.275ZM12 22q-2.075 0-3.9-.788q-1.825-.787-3.175-2.137q-1.35-1.35-2.137-3.175Q2 14.075 2 12t.788-3.9q.787-1.825 2.137-3.175q1.35-1.35 3.175-2.138Q9.925 2 12 2t3.9.787q1.825.788 3.175 2.138q1.35 1.35 2.137 3.175Q22 9.925 22 12t-.788 3.9q-.787 1.825-2.137 3.175q-1.35 1.35-3.175 2.137Q14.075 22 12 22Z" /></svg>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </label>
                            </div>
                        </div>
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
