<x-app-layout>
<div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col justify-between items-center mb-6">
        @if ($errors->any())
            @error('exploring_job')
                <h2 class="text-1xl font-semibold text-red-600">* {{ $message }}</h2>
            @enderror
        @else
            <h2 class="text-1xl font-semibold text-blue-700">Prefered Work Location</h2>
        @endif
    </div>
    <div class="bg-white shadow-sm border border-gray-200 rounded-xl overflow-hidden">
        <div class="p-6">
        <form action="{{ route('work_location', $user->idno) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-6">

                <div>
                    <label class="cursor-pointer bg-white ">
                        <input type="radio" class="peer sr-only" name="work_location" value="1" required/>

                        <div class="w-full max-w-xl rounded-t-md bg-white p-5 text-gray-600 ring-2 ring-transparent transition-all hover:shadow peer-checked:text-sky-600 peer-checked:ring-blue-400 peer-checked:ring-offset-2">
                            <div class="flex flex-col gap-1">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-semibold uppercase text-gray-500 peer-checked:text-sky-600">LOCAL</p>
                                    <div class="peer-checked:text-sky-600">
                                        <svg width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m10.6 13.8l-2.175-2.175q-.275-.275-.675-.275t-.7.3q-.275.275-.275.7q0 .425.275.7L9.9 15.9q.275.275.7.275q.425 0 .7-.275l5.675-5.675q.275-.275.275-.675t-.3-.7q-.275-.275-.7-.275q-.425 0-.7.275ZM12 22q-2.075 0-3.9-.788q-1.825-.787-3.175-2.137q-1.35-1.35-2.137-3.175Q2 14.075 2 12t.788-3.9q.787-1.825 2.137-3.175q1.35-1.35 3.175-2.138Q9.925 2 12 2t3.9.787q1.825.788 3.175 2.138q1.35 1.35 2.137 3.175Q22 9.925 22 12t-.788 3.9q-.787 1.825-2.137 3.175q-1.35 1.35-3.175 2.137Q14.075 22 12 22Z" /></svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="relative w-full max-w-xl hidden peer-checked:block rounded-b-md ring-2 ring-transparent transition-all hover:shadow peer-checked:text-sky-600 peer-checked:ring-blue-400 peer-checked:ring-offset-2">
                            <label for="specify_location" class="block w-full cursor-text rounded-b-md bg-white p-2 pt-2 text-gray-600 ring-2 ring-transparent transition-all peer-checked:ring-blue-400 peer-checked:ring-offset-2 border-t-0">
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
                                        class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('town') border-red-500 @enderror" required disabled>
                                            <option value="">Select Town/City</option>
                                        </select>
                                    </div>
                                </div>

                                <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const provinceSelect = document.getElementById('province');
                                    const townSelect = document.getElementById('town');

                                    // Use Blade syntax to generate absolute base URLs natively
                                    const provincesUrl = "{{ url('/api/provinces') }}";
                                    const townsUrl     = "{{ url('/api/towns') }}";

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
                                        townSelect.disabled = true;

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
                                });
                                </script>
                            </label>
                        </div>
                    </label>
                    <label class="cursor-pointer bg-white ">
                        <input type="radio" class="peer sr-only" name="work_location" value="2" required/>

                        <div class="w-full max-w-xl rounded-t-md bg-white p-5 text-gray-600 ring-2 ring-transparent transition-all hover:shadow peer-checked:text-sky-600 peer-checked:ring-blue-400 peer-checked:ring-offset-2">
                            <div class="flex flex-col gap-1">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-semibold uppercase text-gray-500 peer-checked:text-sky-600">OVERSEAS</p>
                                    <div class="peer-checked:text-sky-600">
                                        <svg width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m10.6 13.8l-2.175-2.175q-.275-.275-.675-.275t-.7.3q-.275.275-.275.7q0 .425.275.7L9.9 15.9q.275.275.7.275q.425 0 .7-.275l5.675-5.675q.275-.275.275-.675t-.3-.7q-.275-.275-.7-.275q-.425 0-.7.275ZM12 22q-2.075 0-3.9-.788q-1.825-.787-3.175-2.137q-1.35-1.35-2.137-3.175Q2 14.075 2 12t.788-3.9q.787-1.825 2.137-3.175q1.35-1.35 3.175-2.138Q9.925 2 12 2t3.9.787q1.825.788 3.175 2.138q1.35 1.35 2.137 3.175Q22 9.925 22 12t-.788 3.9q-.787 1.825-2.137 3.175q-1.35 1.35-3.175 2.137Q14.075 22 12 22Z" /></svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="relative w-full max-w-xl hidden peer-checked:block rounded-b-md ring-2 ring-transparent transition-all hover:shadow peer-checked:text-sky-600 peer-checked:ring-blue-400 peer-checked:ring-offset-2">
                            <label for="specify_country" class="block w-full cursor-text rounded-b-md bg-white p-2 pt-2 text-gray-600 ring-2 ring-transparent transition-all peer-checked:ring-blue-400 peer-checked:ring-offset-2 border-t-0">
                                <input type="text" id="specify_country" name="specify_country" autocomplete="off" maxlength="60" oninput="this.value = this.value.toUpperCase()" class="w-full bg-transparent border-none p-0 focus:ring-0 text-blue-800 font-bold placeholder-gray-400" placeholder="Specify Countries"/>
                            </label>
                        </div>
                    </label>
                </div>
                <!-- Buttons -->
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
            </div>
        </form>
    </div>
</div>

</x-app-layout>

