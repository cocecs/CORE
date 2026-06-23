<x-app-layout>
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
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
    <div class="flex flex-col justify-between items-center mb-6">
        <h2 class="text-1xl font-semibold text-blue-700">Add more about you. Profiles with a bio get a big chance of matches. Add you personal summary, a brief introduction highlighting your career goals and key strengths.</h2>
    </div>
</div>
<form action="{{ route('about.update', $user->idno) }}" method="POST">
@csrf
@method('PUT')
<div class="flex items-center justify-center mb-6">
  <div class="mx-auto max-w-6xl px-12">
    <div class="grid grid-cols-1 gap-6">
        <div class="flex flex-wrap gap-3">
            <div class="w-full max-w-sm">
                <label for="message" class="block text-sm font-medium text-gray-700 mb-1">About you</label>
                <textarea name="about_me"
                class="w-full p-4 bg-gray-50 border-transparent rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 outline-none resize-none"
                placeholder="Type your thoughts here..."
                rows="5"
                ></textarea>
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
