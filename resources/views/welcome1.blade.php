<x-app-layout>
<div class="from-blue-50 to-indigo-100 bg-gradient-to-r">
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col justify-between items-center mb-6 mt-10">
        <h2 class="text-3xl font-semibold text-blue-700 mx-auto text-center">Welcome to C.O.R.E. <br/> Career Opportunities and Recommendation Engine.</h2>
        <p class="mt-4 text-lg text-gray-600 text-center">Your journey to a successful career starts here. Create your CV and explore tailored job opportunities.</p>
        <a href="{{ route('details.index') }}"class="mt-8 px-8 py-3 bg-white text-blue-700 font-bold rounded-lg shadow-md hover:bg-blue-50 hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1">
            Start the CV</a>
    </div>
</div>
</div>
</x-app-layout>
