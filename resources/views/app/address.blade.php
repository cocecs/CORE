<x-app-layout>
<div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- @if (session('success'))
        <div x-data="{ show: true }" x-show="show" class="mb-4 flex items-center justify-between p-4 text-green-700 bg-green-100 border border-green-200 rounded-lg" role="alert">
            <div class="flex items-center">
                <span class="font-bold mr-1">Success!</span> {{ session('success') }}
            </div>
            <button @click="show = false" type="button" class="text-green-700 hover:text-green-900">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
    @endif --}}
    <div class="flex flex-col justify-between items-center">
        @if ($errors->has('province') || $errors->has('town') || $errors->has('brgy'))
            {{-- This shows if any of the three fields fail validation --}}
            <h2 class="text-1xl font-semibold text-red-600">
                * Please check your details. Some required fields are missing.
            </h2>
        @else
            <h2 class="text-1xl font-semibold text-blue-700">
                Yaayks! Your date of birth has been verified. Now, let's proceed to your present address. Don't worry, your data will be keep safely.
            </h2>
        @endif
    </div>
    <div class="bg-white shadow-sm border border-gray-200 rounded-xl overflow-hidden">
        <div class="p-6">
            <form action="{{ route('app.update', $user->idno) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6">
                    <div>

                        <div>
                            <label for="province" class="block text-sm font-medium text-gray-700 mb-1 mt-3">Province <span class="text-red-700">*</span></label>
                            <select id="province" name="province"
                            class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('province') border-red-500 @enderror" required>
                                <option value="" >Select Province</option>
                            </select>
                        </div>

                        <div>
                            <label for="town" class="block text-sm font-medium text-gray-700 mb-1 mt-3">Town <span class="text-red-700">*</span></label>
                            <select id="town" name="town"
                            class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('town') border-red-500 @enderror"required disabled>
                                <option value="">Select Town/City</option>
                            </select>
                        </div>

                        <div>
                            <label for="barangay" class="block text-sm font-medium text-gray-700 mb-1 mt-3">Barangay <span class="text-red-700">*</span></label>
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
                    <!-- Address -->
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address <span class="italic text-gray-400">(Bldg./House#/Street/Village)</span></label>
                        <input type="text" id="address" name="address"
                            value="{{ old('address', $post->address ?? '') }}"
                            placeholder="Details of Address"
                            class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('address') border-red-500 @enderror">

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

