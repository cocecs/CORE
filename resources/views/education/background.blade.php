<x-app-layout>
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col justify-between items-center">
        @if ($errors->any())
            @error('educational_level')
                <h2 class="text-1xl font-semibold text-red-600">* {{ $message }}</h2>
            @enderror
        @else
            <h2 class="text-1xl font-semibold text-blue-700">Great {{ $user->firstname }}! Where now in the Stage 2. Let's identify your level of education.</h2>
        @endif
    </div>
</div>
<form action="{{ route('background.update', $user->idno) }}" method="POST">
@csrf
@method('PUT')
    <div class="flex items-center justify-center mb-6">
        <div class="mx-auto w-full max-w-md px-6">
            <div class="flex flex-col gap-4">
                <label class="cursor-pointer">
                    <input type="radio" class="peer sr-only" name="educational_level" value="0" />
                    <div class="w-full max-w-xl rounded-md bg-white p-5 text-gray-600 ring-2 ring-transparent transition-all hover:shadow peer-checked:text-sky-600 peer-checked:ring-blue-400 peer-checked:ring-offset-2">
                    <div class="flex flex-col gap-1">
                        <div class="flex items-center justify-between">
                        <p class="text-sm font-semibold uppercase text-gray-500">No Formal Education</p>
                        <div>
                            <svg width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m10.6 13.8l-2.175-2.175q-.275-.275-.675-.275t-.7.3q-.275.275-.275.7q0 .425.275.7L9.9 15.9q.275.275.7.275q.425 0 .7-.275l5.675-5.675q.275-.275.275-.675t-.3-.7q-.275-.275-.7-.275q-.425 0-.7.275ZM12 22q-2.075 0-3.9-.788q-1.825-.787-3.175-2.137q-1.35-1.35-2.137-3.175Q2 14.075 2 12t.788-3.9q.787-1.825 2.137-3.175q1.35-1.35 3.175-2.138Q9.925 2 12 2t3.9.787q1.825.788 3.175 2.138q1.35 1.35 2.137 3.175Q22 9.925 22 12t-.788 3.9q-.787 1.825-2.137 3.175q-1.35 1.35-3.175 2.137Q14.075 22 12 22Z" /></svg>
                        </div>
                        </div>
                    </div>
                    </div>
                </label>
                <label class="cursor-pointer">
                    <input type="radio" class="peer sr-only" name="educational_level" value="1" />
                    <div class="w-full max-w-xl rounded-md bg-white p-5 text-gray-600 ring-2 ring-transparent transition-all hover:shadow peer-checked:text-sky-600 peer-checked:ring-blue-400 peer-checked:ring-offset-2">
                    <div class="flex flex-col gap-1">
                        <div class="flex items-center justify-between">
                        <p class="text-sm font-semibold uppercase text-gray-500">Elementary</p>
                        <div>
                            <svg width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m10.6 13.8l-2.175-2.175q-.275-.275-.675-.275t-.7.3q-.275.275-.275.7q0 .425.275.7L9.9 15.9q.275.275.7.275q.425 0 .7-.275l5.675-5.675q.275-.275.275-.675t-.3-.7q-.275-.275-.7-.275q-.425 0-.7.275ZM12 22q-2.075 0-3.9-.788q-1.825-.787-3.175-2.137q-1.35-1.35-2.137-3.175Q2 14.075 2 12t.788-3.9q.787-1.825 2.137-3.175q1.35-1.35 3.175-2.138Q9.925 2 12 2t3.9.787q1.825.788 3.175 2.138q1.35 1.35 2.137 3.175Q22 9.925 22 12t-.788 3.9q-.787 1.825-2.137 3.175q-1.35 1.35-3.175 2.137Q14.075 22 12 22Z" /></svg>
                        </div>
                        </div>
                    </div>
                    </div>
                </label>
                <label class="cursor-pointer">
                    <input type="radio" class="peer sr-only" name="educational_level" value="2" />
                    <div class="w-full max-w-xl rounded-md bg-white p-5 text-gray-600 ring-2 ring-transparent transition-all hover:shadow peer-checked:text-sky-600 peer-checked:ring-blue-400 peer-checked:ring-offset-2">
                    <div class="flex flex-col gap-1">
                        <div class="flex items-center justify-between">
                        <p class="text-sm font-semibold uppercase text-gray-500">High School</p>
                        <div>
                            <svg width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m10.6 13.8l-2.175-2.175q-.275-.275-.675-.275t-.7.3q-.275.275-.275.7q0 .425.275.7L9.9 15.9q.275.275.7.275q.425 0 .7-.275l5.675-5.675q.275-.275.275-.675t-.3-.7q-.275-.275-.7-.275q-.425 0-.7.275ZM12 22q-2.075 0-3.9-.788q-1.825-.787-3.175-2.137q-1.35-1.35-2.137-3.175Q2 14.075 2 12t.788-3.9q.787-1.825 2.137-3.175q1.35-1.35 3.175-2.138Q9.925 2 12 2t3.9.787q1.825.788 3.175 2.138q1.35 1.35 2.137 3.175Q22 9.925 22 12t-.788 3.9q-.787 1.825-2.137 3.175q-1.35 1.35-3.175 2.137Q14.075 22 12 22Z" /></svg>
                        </div>
                        </div>
                    </div>
                    </div>
                </label>
                <label class="cursor-pointer bg-white ">
                    <input type="radio" id="vocational" class="peer sr-only" name="educational_level" value="3" />

                    <div class="w-full max-w-xl rounded-t-md bg-white p-5 text-gray-600 ring-2 ring-transparent transition-all hover:shadow peer-checked:text-sky-600 peer-checked:ring-blue-400 peer-checked:ring-offset-2">
                        <div class="flex flex-col gap-1">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-semibold uppercase text-gray-500 peer-checked:text-sky-600">Vocational</p>
                                <div class="peer-checked:text-sky-600">
                                    <svg width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m10.6 13.8l-2.175-2.175q-.275-.275-.675-.275t-.7.3q-.275.275-.275.7q0 .425.275.7L9.9 15.9q.275.275.7.275q.425 0 .7-.275l5.675-5.675q.275-.275.275-.675t-.3-.7q-.275-.275-.7-.275q-.425 0-.7.275ZM12 22q-2.075 0-3.9-.788q-1.825-.787-3.175-2.137q-1.35-1.35-2.137-3.175Q2 14.075 2 12t.788-3.9q.787-1.825 2.137-3.175q1.35-1.35 3.175-2.138Q9.925 2 12 2t3.9.787q1.825.788 3.175 2.138q1.35 1.35 2.137 3.175Q22 9.925 22 12t-.788 3.9q-.787 1.825-2.137 3.175q-1.35 1.35-3.175 2.137Q14.075 22 12 22Z" /></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative w-full max-w-xl hidden peer-checked:block rounded-b-md ring-2 ring-transparent transition-all hover:shadow peer-checked:text-sky-600 peer-checked:ring-blue-400 peer-checked:ring-offset-2">
                        <label for="custom_course" class="block w-full cursor-text rounded-b-md bg-white p-2 pt-2 text-gray-600 ring-2 ring-transparent transition-all peer-checked:ring-blue-400 peer-checked:ring-offset-2 border-t-0">
                            <input type="text" id="custom_course" name="custom_course[]" autocomplete="off" maxlength="60" oninput="this.value = this.value.toUpperCase()" class="w-full bg-transparent border-none p-0 focus:ring-0 text-blue-800 font-bold placeholder-gray-400" placeholder="Type your technical course here..."/>
                        </label>
                    </div>
                </label>
                <label class="cursor-pointer bg-white ">
                    <input type="radio" id="associate" class="peer sr-only" name="educational_level" value="4" />

                    <div class="w-full max-w-xl rounded-t-md bg-white p-5 text-gray-600 ring-2 ring-transparent transition-all hover:shadow peer-checked:text-sky-600 peer-checked:ring-blue-400 peer-checked:ring-offset-2">
                        <div class="flex flex-col gap-1">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-semibold uppercase text-gray-500 peer-checked:text-sky-600">Associate Degree</p>
                                <div class="peer-checked:text-sky-600">
                                    <svg width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m10.6 13.8l-2.175-2.175q-.275-.275-.675-.275t-.7.3q-.275.275-.275.7q0 .425.275.7L9.9 15.9q.275.275.7.275q.425 0 .7-.275l5.675-5.675q.275-.275.275-.675t-.3-.7q-.275-.275-.7-.275q-.425 0-.7.275ZM12 22q-2.075 0-3.9-.788q-1.825-.787-3.175-2.137q-1.35-1.35-2.137-3.175Q2 14.075 2 12t.788-3.9q.787-1.825 2.137-3.175q1.35-1.35 3.175-2.138Q9.925 2 12 2t3.9.787q1.825.788 3.175 2.138q1.35 1.35 2.137 3.175Q22 9.925 22 12t-.788 3.9q-.787 1.825-2.137 3.175q-1.35 1.35-3.175 2.137Q14.075 22 12 22Z" /></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative w-full max-w-xl hidden peer-checked:block rounded-b-md ring-2 ring-transparent transition-all hover:shadow peer-checked:text-sky-600 peer-checked:ring-blue-400 peer-checked:ring-offset-2">
                        <label for="custom_course" class="block w-full cursor-text rounded-b-md bg-white p-2 pt-2 text-gray-600 ring-2 ring-transparent transition-all peer-checked:ring-blue-400 peer-checked:ring-offset-2 border-t-0">
                            <input type="text" id="custom_course" name="custom_course[]" autocomplete="off" maxlength="60" oninput="this.value = this.value.toUpperCase()" class="w-full bg-transparent border-none p-0 focus:ring-0 text-blue-800 font-bold placeholder-gray-400" placeholder="Type your associate course here..."/>
                        </label>
                    </div>
                </label>
                <label class="cursor-pointer bg-white ">
                    <input type="radio" id="bachelor" class="peer sr-only" name="educational_level" value="5" />

                    <div class="w-full max-w-xl rounded-t-md bg-white p-5 text-gray-600 ring-2 ring-transparent transition-all hover:shadow peer-checked:text-sky-600 peer-checked:ring-blue-400 peer-checked:ring-offset-2">
                        <div class="flex flex-col gap-1">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-semibold uppercase text-gray-500 peer-checked:text-sky-600">Bachelor's Degree</p>
                                <div class="peer-checked:text-sky-600">
                                    <svg width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m10.6 13.8l-2.175-2.175q-.275-.275-.675-.275t-.7.3q-.275.275-.275.7q0 .425.275.7L9.9 15.9q.275.275.7.275q.425 0 .7-.275l5.675-5.675q.275-.275.275-.675t-.3-.7q-.275-.275-.7-.275q-.425 0-.7.275ZM12 22q-2.075 0-3.9-.788q-1.825-.787-3.175-2.137q-1.35-1.35-2.137-3.175Q2 14.075 2 12t.788-3.9q.787-1.825 2.137-3.175q1.35-1.35 3.175-2.138Q9.925 2 12 2t3.9.787q1.825.788 3.175 2.138q1.35 1.35 2.137 3.175Q22 9.925 22 12t-.788 3.9q-.787 1.825-2.137 3.175q-1.35 1.35-3.175 2.137Q14.075 22 12 22Z" /></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative w-full max-w-xl hidden peer-checked:block rounded-b-md ring-2 ring-transparent transition-all hover:shadow peer-checked:text-sky-600 peer-checked:ring-blue-400 peer-checked:ring-offset-2">
                        <label for="custom_course" class="block w-full cursor-text rounded-b-md bg-white p-2 pt-2 text-gray-600 ring-2 ring-transparent transition-all peer-checked:ring-blue-400 peer-checked:ring-offset-2 border-t-0">
                            <input type="text" id="custom_course" name="custom_course[]" autocomplete="off" maxlength="60" oninput="this.value = this.value.toUpperCase()" class="w-full bg-transparent border-none p-0 focus:ring-0 text-blue-800 font-bold placeholder-gray-400" placeholder="Type your degree course here..."/>
                        </label>
                    </div>
                </label>
                <label class="cursor-pointer bg-white ">
                    <input type="radio" id="masters" class="peer sr-only" name="educational_level" value="6" />

                    <div class="w-full max-w-xl rounded-t-md bg-white p-5 text-gray-600 ring-2 ring-transparent transition-all hover:shadow peer-checked:text-sky-600 peer-checked:ring-blue-400 peer-checked:ring-offset-2">
                        <div class="flex flex-col gap-1">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-semibold uppercase text-gray-500 peer-checked:text-sky-600">Masters</p>
                                <div class="peer-checked:text-sky-600">
                                    <svg width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m10.6 13.8l-2.175-2.175q-.275-.275-.675-.275t-.7.3q-.275.275-.275.7q0 .425.275.7L9.9 15.9q.275.275.7.275q.425 0 .7-.275l5.675-5.675q.275-.275.275-.675t-.3-.7q-.275-.275-.7-.275q-.425 0-.7.275ZM12 22q-2.075 0-3.9-.788q-1.825-.787-3.175-2.137q-1.35-1.35-2.137-3.175Q2 14.075 2 12t.788-3.9q.787-1.825 2.137-3.175q1.35-1.35 3.175-2.138Q9.925 2 12 2t3.9.787q1.825.788 3.175 2.138q1.35 1.35 2.137 3.175Q22 9.925 22 12t-.788 3.9q-.787 1.825-2.137 3.175q-1.35 1.35-3.175 2.137Q14.075 22 12 22Z" /></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative w-full max-w-xl hidden peer-checked:block rounded-b-md ring-2 ring-transparent transition-all hover:shadow peer-checked:text-sky-600 peer-checked:ring-blue-400 peer-checked:ring-offset-2">
                        <label for="custom_course" class="block w-full cursor-text rounded-b-md bg-white p-2 pt-2 text-gray-600 ring-2 ring-transparent transition-all peer-checked:ring-blue-400 peer-checked:ring-offset-2 border-t-0">
                            <input type="text" id="custom_course" name="custom_course[]" autocomplete="off" maxlength="60" oninput="this.value = this.value.toUpperCase()" class="w-full bg-transparent border-none p-0 focus:ring-0 text-blue-800 font-bold placeholder-gray-400" placeholder="Type your course here..."/>
                        </label>
                    </div>
                </label>
                <label class="cursor-pointer bg-white ">
                    <input type="radio" id="doctoral" class="peer sr-only" name="educational_level" value="7" />

                    <div class="w-full max-w-xl rounded-t-md bg-white p-5 text-gray-600 ring-2 ring-transparent transition-all hover:shadow peer-checked:text-sky-600 peer-checked:ring-blue-400 peer-checked:ring-offset-2">
                        <div class="flex flex-col gap-1">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-semibold uppercase text-gray-500 peer-checked:text-sky-600">Doctorate</p>
                                <div class="peer-checked:text-sky-600">
                                    <svg width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m10.6 13.8l-2.175-2.175q-.275-.275-.675-.275t-.7.3q-.275.275-.275.7q0 .425.275.7L9.9 15.9q.275.275.7.275q.425 0 .7-.275l5.675-5.675q.275-.275.275-.675t-.3-.7q-.275-.275-.7-.275q-.425 0-.7.275ZM12 22q-2.075 0-3.9-.788q-1.825-.787-3.175-2.137q-1.35-1.35-2.137-3.175Q2 14.075 2 12t.788-3.9q.787-1.825 2.137-3.175q1.35-1.35 3.175-2.138Q9.925 2 12 2t3.9.787q1.825.788 3.175 2.138q1.35 1.35 2.137 3.175Q22 9.925 22 12t-.788 3.9q-.787 1.825-2.137 3.175q-1.35 1.35-3.175 2.137Q14.075 22 12 22Z" /></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative w-full max-w-xl hidden peer-checked:block rounded-b-md ring-2 ring-transparent transition-all hover:shadow peer-checked:text-sky-600 peer-checked:ring-blue-400 peer-checked:ring-offset-2">
                        <label for="custom_course" class="block w-full cursor-text rounded-b-md bg-white p-2 pt-2 text-gray-600 ring-2 ring-transparent transition-all peer-checked:ring-blue-400 peer-checked:ring-offset-2 border-t-0">
                            <input type="text" id="custom_course" name="custom_course[]" autocomplete="off" maxlength="60" oninput="this.value = this.value.toUpperCase()" class="w-full bg-transparent border-none p-0 focus:ring-0 text-blue-800 font-bold placeholder-gray-400" placeholder="Type your course here..."/>
                        </label>
                    </div>
                </label>
            </div>
        </div>
    </div>

<div class="flex items-center justify-center mb-6">
    <div class="mx-auto max-w-6xl px-12">
        <div class="mt-8 flex gap-3">
            <button type="submit" id="nextButton" class="px-6 py-2 bg-indigo-600 text-white rounded-md font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
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

