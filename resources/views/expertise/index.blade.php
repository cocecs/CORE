<x-app-layout>
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col justify-between items-center">
        @if ($errors->any() || session('error'))
            {{-- 1. Display your specific validation error if it exists --}}
            @error('expertise')
                <h2 class="text-1xl font-semibold text-red-600">*ad {{ $message }}</h2>
            @enderror

            {{-- 2. Display the redirect flash error message --}}
            @if (session('error'))
                <h2 class="text-1xl font-semibold text-red-600">* {{ session('error') }}</h2>
            @endif
        @else
            <h2 class="text-1xl font-semibold text-blue-700">Wow! You earned {{ $user->educational_level }}. <br/>Select your areas of expertise</h2>
        @endif
    </div>
</div>
<form action="{{ route('skills.store', $user->idno) }}" method="POST">
@csrf
@method('PUT')
<div class="flex items-center mb-6">
  <div class="mx-auto max-w-6xl px-12 w-full">
    <div class="grid grid-cols-1 gap-6">
        <div class="flex flex-wrap justify-center gap-3">
            {{-- 1. Parse the JSON string from your single, matched expertise model --}}
            @php
                $skillsArray = is_array($expertise->skills) ? $expertise->skills : json_decode($expertise->skills, true);
            @endphp

            {{-- 2. Loop exclusively through the 34 specific skills array belonging to this course --}}
            @forelse(($skillsArray ?? []) as $skill)
                @php $trimmedSkill = trim($skill); @endphp

                <label class="w-fit max-w-xl cursor-pointer mb-2">
                    {{-- Use the clean skill name as the value so it's sent to your controller --}}
                    <input type="checkbox" class="peer sr-only" name="skills[]" value="{{ $trimmedSkill }}"/>

                    <div class="w-fit max-w-xl rounded-md bg-white p-2 text-gray-600 ring-2 ring-transparent transition-all hover:shadow peer-checked:text-sky-600 peer-checked:ring-blue-400 peer-checked:ring-offset-2">
                        <div class="flex flex-col gap-1">
                            <div class="flex items-center justify-between">
                                {{-- Display the single skill cleanly here --}}
                                <p class="text-sm font-semibold uppercase text-gray-500">
                                    {{ $trimmedSkill }}
                                </p>
                            </div>
                        </div>
                    </div>
                </label>
            @empty
                <p class="text-gray-500 text-sm">No skills found matching this specific course track.</p>
            @endforelse
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

