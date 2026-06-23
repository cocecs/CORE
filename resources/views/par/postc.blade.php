<x-app-layout>
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
<style>
    /* Strictly force the textareas to remain expanded layout sizes */
    .wysiwyg-container .ql-toolbar.ql-snow {
        border: 1px solid #d1d5db !important;
        border-bottom: none !important;
        border-top-left-radius: 0.375rem !important;
        border-top-right-radius: 0.375rem !important;
        background-color: #f9fafb;
    }
    .wysiwyg-container .ql-container.ql-snow {
        border: 1px solid #d1d5db !important;
        border-top: none !important;
        border-bottom-left-radius: 0.375rem !important;
        border-bottom-right-radius: 0.375rem !important;
        min-height: 200px !important; /* Forces layout to stay open physically */
        height: 200px !important;
        font-family: inherit;
        font-size: 0.875rem !important;
    }
    /* Error Border Handling Changes */
    .has-error .ql-toolbar.ql-snow,
    .has-error .ql-container.ql-snow {
        border-color: #ef4444 !important;
    }
</style>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col justify-between items-center">
        @if ($errors->has('job_title') || $errors->has('job_description') || $errors->has('job_requirements'))
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

<form action="{{ route('job_postc', ['job_id' => $job_id]) }}" method="POST" id="jobPostForm">
@csrf
@method('PUT')

<div class="flex items-center justify-center">
  <div class="mx-auto w-full max-w-2xl px-6">
    <div class="flex flex-col gap-6">
        <div class="w-full rounded-md bg-white p-6 text-gray-600 border border-gray-200 shadow-xs">

            <div class="w-full mb-4">
                <label for="job_title" class="block text-sm font-medium text-gray-700 mb-1">Job Title <span class="text-red-700">*</span></label>
                <input type="text" name="job_title" id="job_title" value="{{ old('job_title') }}"
                    class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 {{ $errors->has('job_title') ? 'border-red-500' : '' }}">
                @error('job_title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="w-full mb-4 wysiwyg-container {{ $errors->has('job_description') ? 'has-error' : '' }}">
                <label class="block text-sm font-medium text-gray-700 mb-1">Job Description <span class="text-red-700">*</span></label>
                <div class="relative block w-full">
                    <div id="editor_description" class="bg-white">
                        {!! old('job_description') !!}
                    </div>
                    <div class="absolute bottom-2 right-3 pointer-events-none text-slate-400 text-xs select-none">///</div>
                </div>
                <input type="hidden" name="job_description" id="job_description_hidden" value="{{ old('job_description') }}">
                @error('job_description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="w-full mb-2 wysiwyg-container {{ $errors->has('job_requirements') ? 'has-error' : '' }}">
                <label class="block text-sm font-medium text-gray-700 mb-1">Job Requirements</label>
                <div class="relative block w-full">
                    <div id="editor_requirements" class="bg-white">
                        {!! old('job_requirements') !!}
                    </div>
                    <div class="absolute bottom-2 right-3 pointer-events-none text-slate-400 text-xs select-none">///</div>
                </div>
                <input type="hidden" name="job_requirements" id="job_requirements_hidden" value="{{ old('job_requirements') }}">
                @error('job_requirements') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

        </div>
    </div>
  </div>
</div>

<div class="flex items-center justify-center mb-12">
    <div class="mx-auto w-full max-w-2xl px-6">
        <div class="mt-6 flex gap-3">
            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition cursor-pointer">
                Next
            </button>
            <button type="reset" class="px-6 py-2 bg-white text-gray-700 border border-gray-300 rounded-md font-semibold hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition cursor-pointer">
                Reset
            </button>
        </div>
    </div>
</div>
</form>

<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Toolbar settings map setup
        const layoutToolbarOptions = [
            ['bold', 'italic', 'underline'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            ['clean']
        ];

        // Init Editor 1: Description
        const quillDescription = new Quill('#editor_description', {
            theme: 'snow',
            placeholder: 'Detail key roles, expectations, and day-to-day operations...',
            modules: { toolbar: layoutToolbarOptions }
        });

        // Init Editor 2: Requirements
        const quillRequirements = new Quill('#editor_requirements', {
            theme: 'snow',
            placeholder: 'Detail experience benchmarks, core skill sets, and backgrounds required...',
            modules: { toolbar: layoutToolbarOptions }
        });

        // Event Listeners updating hidden fields in real-time
        quillDescription.on('text-change', function() {
            let htmlValue = quillDescription.root.innerHTML;
            if (htmlValue === '<p><br></p>') htmlValue = '';
            document.getElementById('job_description_hidden').value = htmlValue;
        });

        quillRequirements.on('text-change', function() {
            let htmlValue = quillRequirements.root.innerHTML;
            if (htmlValue === '<p><br></p>') htmlValue = '';
            document.getElementById('job_requirements_hidden').value = htmlValue;
        });
    });
</script>
</x-app-layout>
