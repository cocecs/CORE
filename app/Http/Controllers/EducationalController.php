<?php

namespace App\Http\Controllers;

use App\Models\Educational;
use App\Models\User;
use App\Http\Requests\StoreEducationalRequest;
use App\Http\Requests\UpdateEducationalRequest;
use App\Http\Requests\UpdateUserCourseRequest;
use App\Models\UserDetails;

class EducationalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('education.background');
        $user = User::where('idno', auth()->user()->idno)->first();
        return view('education.background', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function vocational()
    {
        $user = User::where('idno', auth()->user()->idno)->first();
        return view('education.vocational', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEducationalRequest $request)
    {
        $idno = auth()->user()->idno;
        Educational::create(array_merge($request->validated(), ['idno' => $idno]));
        return redirect()->route('background.index')->with('success', 'User details saved successfully.');
    }
    public function updateCourse(UpdateUserCourseRequest $request, $idno)
    {
        // 1. Extract the string from the custom_course array
        $customCourse = null;
        if ($request->has('custom_course')) {
            // Filter the array to find the index that isn't empty (e.g., "BACHELOR")
            $customCourse = collect($request->custom_course)->filter()->first();
        }

        // 2. Determine what to save
        // If a custom course was typed, use that. Otherwise, use the radio value.
        $levelToSave = $customCourse ? strtoupper($customCourse) : $request->educational_level;

        // 3. Find and Update
        $userCourse = UserDetails::where('idno', $idno)->firstOrFail();

        $userCourse->update([
            'educational_level' => $levelToSave
        ]);

        // $idno = auth()->user()->idno;
        // Educational::create(array_merge($request->validated(), ['idno' => $idno, 'course_degree' => $levelToSave]));

        return redirect()->route('expertise.process')->with('success', 'User details saved successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(educational $educational)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(educational $educational)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateeducationalRequest $request, educational $educational)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(educational $educational)
    {
        //
    }
}
