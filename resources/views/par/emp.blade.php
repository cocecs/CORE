<x-app-layout>
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="flex flex-col justify-between items-center">
        @if ($errors->has('job_type') || $errors->has('job_category') || $errors->has('skills_required'))
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
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Employer Profile</h2>

    <form action="{{ route('update_emp_comp', $employer->idno) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Hidden ID / Reference -->
        <input type="hidden" name="idno" value="{{ old('idno', $employer->idno) }}">

        <!-- Account & Basic Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">Company Name</label>
                <input type="text" id="company_name" name="company_name"
                       value="{{ old('company_name', $employer->company_name) }}"
                       maxlength="50" required
                       class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('company_name') border-red-500 @enderror">
                @error('company_name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="type_of_business" class="block text-sm font-medium text-gray-700 mb-1">Type of Business</label>
                <input type="text" id="type_of_business" name="type_of_business"
                       value="{{ old('type_of_business', $employer->type_of_business) }}"
                       maxlength="50" required
                       class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('type_of_business') border-red-500 @enderror">
                @error('type_of_business') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" id="email" name="email"
                       value="{{ old('email', $employer->email) }}"
                       maxlength="50" required
                       class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror">
                @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="tin" class="block text-sm font-medium text-gray-700 mb-1">TIN</label>
                <input type="text" id="tin" name="tin"
                       value="{{ old('tin', $employer->tin) }}"
                       maxlength="15"
                       class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('tin') border-red-500 @enderror">
                @error('tin') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Address Details -->
        <div class="border-t pt-4">
            <h3 class="text-lg font-semibold text-gray-700 mb-3">Address</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="province" class="block text-sm font-medium text-gray-700 mb-1">Province</label>
                    <select id="province" name="province"
                    class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('province') border-red-500 @enderror" required>
                        <option value="" >Select Province</option>
                    </select>

                </div>

                <div>
                    <label for="town" class="block text-sm font-medium text-gray-700 mb-1">Town / City</label>
                    <select id="town" name="town"
                    class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('town') border-red-500 @enderror"required disabled>
                        <option value="">Select Town/City</option>
                    </select>
                </div>

                <div>
                    <label for="brgy" class="block text-sm font-medium text-gray-700 mb-1">Barangay</label>
                    <select id="barangay" name="brgy" required disabled
                    class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('brgy') border-red-500 @enderror">
                        <option value="">Select Barangay</option>
                    </select>
                </div>
            </div>
            <script>
            document.addEventListener('DOMContentLoaded', function () {
                const provinceSelect = document.getElementById('province');
                const townSelect = document.getElementById('town');
                const barangaySelect = document.getElementById('barangay');

                // Use Blade syntax to generate absolute base URLs natively
                const provincesUrl = "{{ url('/api/provinces') }}";
                const townsUrl     = "{{ url('/api/towns') }}";
                const barangaysUrl = "{{ url('/api/barangays') }}";

                // 1. Fetch Provinces
                fetch(provincesUrl)
                    .then(res => {
                        if (!res.ok) throw new Error('Network response error');
                        return res.json();
                    })
                    .then(provinces => {
                        provinces.forEach(province => {
                            let opt = document.createElement('option');
                            opt.value = province;
                            opt.textContent = province;
                            provinceSelect.appendChild(opt);
                        });
                    })
                    .catch(err => console.error('Error fetching provinces:', err));

                // 2. When Province Changes
                provinceSelect.addEventListener('change', function () {
                    const province = this.value;

                    townSelect.innerHTML = '<option value="">Select Town/City</option>';
                    barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
                    townSelect.disabled = true;
                    barangaySelect.disabled = true;

                    if (!province) return;

                    fetch(`${townsUrl}?province=${encodeURIComponent(province)}`)
                        .then(res => res.json())
                        .then(towns => {
                            towns.forEach(t => {
                                let opt = document.createElement('option');
                                opt.value = t.id;
                                opt.textContent = t.town;
                                townSelect.appendChild(opt);
                            });
                            townSelect.disabled = false;
                        });
                });

                // 3. When Town Changes
                townSelect.addEventListener('change', function () {
                    const townId = this.value;

                    barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
                    barangaySelect.disabled = true;

                    if (!townId) return;

                    fetch(`${barangaysUrl}?town_id=${townId}`)
                        .then(res => res.json())
                        .then(barangays => {
                            barangays.forEach(b => {
                                let opt = document.createElement('option');
                                opt.value = b.id;
                                opt.textContent = b.barangay;
                                barangaySelect.appendChild(opt);
                            });
                            barangaySelect.disabled = false;
                        });
                });
            });
            </script>
            <div class="mt-4">
                <label for="address_details" class="block text-sm font-medium text-gray-700 mb-1">Street / House No. / Specific Details</label>
                <input type="text" id="address_details" name="address_details"
                       value="{{ old('address_details', $employer->address_details) }}"
                       maxlength="50"
                       class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('address_details') border-red-500 @enderror">
                @error('address_details') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Contact & Representative Info -->
        <div class="border-t pt-4">
            <h3 class="text-lg font-semibold text-gray-700 mb-3">Representative Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="representative_name" class="block text-sm font-medium text-gray-700 mb-1">Representative Name</label>
                    <input type="text" id="representative_name" name="representative_name"
                           value="{{ old('representative_name', $employer->representative_name) }}"
                           maxlength="50"
                           class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('representative_name') border-red-500 @enderror">
                    @error('representative_name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="designation" class="block text-sm font-medium text-gray-700 mb-1">Designation</label>
                    <input type="text" id="designation" name="designation"
                           value="{{ old('designation', $employer->designation) }}"
                           maxlength="50"
                           class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('designation') border-red-500 @enderror">
                    @error('designation') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="tel" class="block text-sm font-medium text-gray-700 mb-1">Telephone</label>
                    <input type="text" id="tel" name="tel"
                           value="{{ old('tel', $employer->tel) }}"
                           maxlength="15"
                           class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('tel') border-red-500 @enderror">
                    @error('tel') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                    <input type="text" id="phone" name="phone"
                           value="{{ old('phone', $employer->phone) }}"
                           maxlength="15"
                           class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('phone') border-red-500 @enderror">
                    @error('phone') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="mobile" class="block text-sm font-medium text-gray-700 mb-1">Mobile</label>
                    <input type="text" id="mobile" name="mobile"
                           value="{{ old('mobile', $employer->mobile) }}"
                           maxlength="50"
                           class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('mobile') border-red-500 @enderror">
                    @error('mobile') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Additional Company Profile -->
        <div class="border-t pt-4 space-y-4">
            <div>
                <label for="company_logo" class="block text-sm font-medium text-gray-700 mb-1">Company Logo</label>
                @if($employer->company_logo)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $employer->company_logo) }}" alt="Logo" class="h-16 w-16 object-cover rounded">
                    </div>
                @endif
                <input type="file" id="company_logo" name="company_logo"
                       class="w-full border rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('company_logo') border-red-500 @enderror">
                @error('company_logo') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="about" class="block text-sm font-medium text-gray-700 mb-1">About Company</label>
                <textarea id="about" name="about" rows="4" maxlength="255"
                          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('about') border-red-500 @enderror">{{ old('about', $employer->about) }}</textarea>
                @error('about') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200 font-medium">
                Save Changes
            </button>
        </div>
    </form>
</div>

</x-app-layout>
