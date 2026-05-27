<x-app-layout>
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col justify-between items-center mb-6">
        @if ($errors->any())
            @error('exploring_job')
                <h2 class="text-1xl font-semibold text-red-600">* {{ $message }}</h2>
            @enderror
        @else
            <h2 class="text-1xl font-semibold text-blue-700">Technical / Vocational and other training (include courses taken as part of college education)</h2>
        @endif
    </div>
</div>
<form action="{{ route('vocational_store', $user->idno) }}" method="POST">
@csrf
@method('PUT')
<div class="flex items-center justify-center mb-6">
  <div class="mx-auto w-full max-w-md px-6">
    <div class="flex flex-col gap-4">
        <label for="firstname" class="block text-sm font-medium text-gray-700 mb-1">Training/Vocational Course <span class="text-red-700">*</span></label>
            <input type="text" name="firstname" id="firstname"
                class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('firstname') border-red-500 @enderror">
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

