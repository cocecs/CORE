<x-app-layout>
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col justify-between items-center">
        @if ($errors->any())
            @error('job_history')
                <h2 class="text-1xl font-semibold text-red-600">* {{ $message }}</h2>
            @enderror
        @else
            <h2 class="text-1xl font-semibold text-blue-700">Your current employment status.</h2>
        @endif
    </div>
</div>
<form action="{{ route('job.employment', $user->idno)  }}" method="POST">
@csrf
@method('PUT')
<div x-data="{ status: '', type: '' }">
    <div class="flex items-center justify-center mb-3">
        <div class="mx-auto w-full max-w-md px-6">
            <div class="flex flex-col gap-4">
                <div class="bg-white shadow-sm border border-gray-200 rounded-xl overflow-hidden">
                    <div class="p-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Employment Status </label>
                    <select name="employment_status" x-model="status" class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value=""></option>
                        <option value="1">Employed</option>
                        <option value="0">Unemployed</option>
                    </select>
                    <div x-show="status === '1'" x-transition class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Employment Type </label>
                        <select id="employment_type" x-model="type" name="employment_type" class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 disabled:bg-gray-100">
                            <option value=""></option>
                            <option value="1">Wage employed</option>
                            <option value="2">Self-employed</option>
                        </select>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="grid items-center justify-center mb-6"> --}}

    <div x-show="status === '1' && type === '2'" x-transition class="items-center justify-center mb-3">
        <div class="mx-auto w-full max-w-md px-6">
            <div class="grid grid-cols-2 gap-3">
                <label class="cursor-pointer flex-1">
                    <div class="w-full max-w-xs rounded-md bg-white p-5 text-gray-600 ring-2 ring-transparent transition-all hover:shadow has-[:checked]:ring-blue-400 has-[:checked]:ring-offset-2">
                        <div class="flex flex-row items-center gap-4">
                            <input type="checkbox" name="self_employed_spec[]" autocomplete="off" value="fisherman_fisherfolk" class="h-5 w-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500"/>
                            <p class="text-sm font-semibold uppercase text-gray-500">Fisherman/Fisherfolk</p>
                        </div>
                    </div>
                </label>
                <label class="cursor-pointer flex-1">
                    <div class="w-full max-w-xs rounded-md bg-white p-5 text-gray-600 ring-2 ring-transparent transition-all hover:shadow has-[:checked]:ring-blue-400 has-[:checked]:ring-offset-2">
                        <div class="flex flex-row items-center gap-4">
                            <input type="checkbox" name="self_employed_spec[]" autocomplete="off" value="vendor_retailer" class="h-5 w-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500"/>
                            <p class="text-sm font-semibold uppercase text-gray-500">Vendor/Retailer</p>
                        </div>
                    </div>
                </label>
                <label class="cursor-pointer flex-1">
                    <div class="w-full max-w-xs rounded-md bg-white p-5 text-gray-600 ring-2 ring-transparent transition-all hover:shadow has-[:checked]:ring-blue-400 has-[:checked]:ring-offset-2">
                        <div class="flex flex-row items-center gap-4">
                            <input type="checkbox" name="self_employed_spec[]" autocomplete="off" value="home_based_worker" class="h-5 w-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500"/>
                            <p class="text-sm font-semibold uppercase text-gray-500">Home-based Worker</p>
                        </div>
                    </div>
                </label>
                <label class="cursor-pointer flex-1">
                    <div class="w-full max-w-xs rounded-md bg-white p-5 text-gray-600 ring-2 ring-transparent transition-all hover:shadow has-[:checked]:ring-blue-400 has-[:checked]:ring-offset-2">
                        <div class="flex flex-row items-center gap-4">
                            <input type="checkbox" name="self_employed_spec[]" autocomplete="off" value="transportation_worker" class="h-5 w-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500"/>
                            <p class="text-sm font-semibold uppercase text-gray-500">Transportation Worker</p>
                        </div>
                    </div>
                </label>
                <label class="cursor-pointer flex-1">
                    <div class="w-full max-w-xs rounded-md bg-white p-5 text-gray-600 ring-2 ring-transparent transition-all hover:shadow has-[:checked]:ring-blue-400 has-[:checked]:ring-offset-2">
                        <div class="flex flex-row items-center gap-4">
                            <input type="checkbox" name="self_employed_spec[]" autocomplete="off" value="domestic_worker" class="h-5 w-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500"/>
                            <p class="text-sm font-semibold uppercase text-gray-500">Domestic Worker</p>
                        </div>
                    </div>
                </label>
                <label class="cursor-pointer flex-1">
                    <div class="w-full max-w-xs rounded-md bg-white p-5 text-gray-600 ring-2 ring-transparent transition-all hover:shadow has-[:checked]:ring-blue-400 has-[:checked]:ring-offset-2">
                        <div class="flex flex-row items-center gap-4">
                            <input type="checkbox" name="self_employed_spec[]" autocomplete="off" value="freelancer_contractor" class="h-5 w-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500"/>
                            <p class="text-sm font-semibold uppercase text-gray-500">Freelancer / Contractor</p>
                        </div>
                    </div>
                </label>
                <label class="cursor-pointer flex-1">
                    <div class="w-full max-w-xs rounded-md bg-white p-5 text-gray-600 ring-2 ring-transparent transition-all hover:shadow has-[:checked]:ring-blue-400 has-[:checked]:ring-offset-2">
                        <div class="flex flex-row items-center gap-4">
                            <input type="checkbox" name="self_employed_spec[]" autocomplete="off" value="artisan_craft_worker" class="h-5 w-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500"/>
                            <p class="text-sm font-semibold uppercase text-gray-500">Artisan/Craft Worker</p>
                        </div>
                    </div>
                </label>
                <label class="cursor-pointer flex-1">
                    <div class="w-full max-w-xs rounded-md bg-white p-5 text-gray-600 ring-2 ring-transparent transition-all hover:shadow has-[:checked]:ring-blue-400 has-[:checked]:ring-offset-2">
                        <div class="flex flex-row items-center gap-4">
                            <input type="checkbox" autocomplete="off" name="self_employed_spec[]" value="construction_worker" class="h-5 w-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500"/>
                            <p class="text-sm font-semibold uppercase text-gray-500">Construction Worker</p>
                        </div>
                    </div>
                </label>
            </div>
        </div>
    </div>
    {{-- <div class="flex items-center justify-center mb-6"> --}}
    <div x-show="status === '1' && type === '2'" x-transition class="items-center justify-center mb-6">
        <div class="mx-auto w-full max-w-md px-6">
            <div class="flex flex-col gap-4">
                <label class="cursor-pointer flex-1">
                    <div class="w-full max-w-xl rounded-md bg-white p-5 text-gray-600 ring-2 ring-transparent transition-all hover:shadow has-[:checked]:ring-blue-400 has-[:checked]:ring-offset-2">
                        <label for="others_specify" class="block w-full cursor-text rounded-md bg-white p-2 pt-2 text-gray-600 ring-2 ring-transparent transition-all peer-checked:ring-blue-400 peer-checked:ring-offset-2 border-t-0">
                            <input type="text" id="others_specify" name="others_specify" autocomplete="off" maxlength="60"
                                oninput="this.value = this.value.toUpperCase()"
                                class="w-full bg-transparent border-none p-0 focus:ring-0 text-blue-800 font-bold placeholder-gray-400" placeholder="Others: Please specify..."/>
                        </label>
                    </div>
                </label>
            </div>
        </div>
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
</x-app-layout>

