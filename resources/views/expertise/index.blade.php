<x-app-layout>
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-700">Select your areas of expertise</h2>
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
    @endif --}}
    <div class="flex flex-col justify-between items-center mb-6">
        @if ($errors->any())
            @error('expertise')
                <h2 class="text-1xl font-semibold text-red-600">* {{ $message }}</h2>
            @enderror
        @else
            <h2 class="text-1xl font-semibold text-green-700">Select your areas of expertise</h2>
        @endif
    </div>
</div>
<form action="{{ route('expertise.store', $user->idno) }}" method="POST">
@csrf
@method('PUT')
<div class="flex items-center justify-center mb-6">
  <div class="mx-auto max-w-6xl px-12">
    <div class="grid grid-cols-1 gap-6">
        <div class="flex flex-wrap gap-3">
        <label class="w-fit max-w-xl cursor-pointer">
            <input type="checkbox" class="peer sr-only" name="expertise" value="1"/>
            <div class="w-fit max-w-xl rounded-md bg-white p-2 text-gray-600 ring-2 ring-transparent transition-all hover:shadow peer-checked:text-sky-600 peer-checked:ring-blue-400 peer-checked:ring-offset-2">
            <div class="flex flex-col gap-1">
                <div class="flex items-center justify-between">
                <p class="text-sm font-semibold uppercase text-gray-500">DATA ENTRY</p>

                </div>
            </div>
            </div>
        </label>
        <label class="w-fit max-w-xl cursor-pointer">
            <input type="checkbox" class="peer sr-only" name="expertise" value="2"/>
            <div class="w-fit max-w-xl rounded-md bg-white p-2 text-gray-600 ring-2 ring-transparent transition-all hover:shadow peer-checked:text-sky-600 peer-checked:ring-blue-400 peer-checked:ring-offset-2">
            <div class="flex flex-col gap-1">
                <div class="flex items-center justify-between">
                <p class="text-sm font-semibold uppercase text-gray-500">WEB DEVELOPMENT<br/></p>

                </div>
            </div>
            </div>
        </label>

        <label class="w-fit max-w-xl cursor-pointer">
            <input type="checkbox" class="peer sr-only" name="expertise" value="2"/>
            <div class="w-fit max-w-xl rounded-md bg-white p-2 text-gray-600 ring-2 ring-transparent transition-all hover:shadow peer-checked:text-sky-600 peer-checked:ring-blue-400 peer-checked:ring-offset-2">
            <div class="flex flex-col gap-1">
                <div class="flex items-center justify-between">
                <p class="text-sm font-semibold uppercase text-gray-500">WEB DEVELOPMENT<br/></p>

                </div>
            </div>
            </div>
        </label>
        </div>
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
</form>

</x-app-layout>

