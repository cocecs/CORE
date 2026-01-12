<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\educational;
use App\Http\Requests\StoreEducationalRequest;
use App\Http\Requests\UpdateUserEducationRequest;

class UserEducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('idno', auth()->user()->idno)->first();
        return view('education.background', compact('user'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEducationalRequest $request)
    {
        Educational::create($request->validated());
        return redirect()->route('education.index')->with('success', 'User education background saved successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEducationalRequest $request, $idno)
    {
        //dump and die request data for debugging
        // dd($request->civil_status);
        // dd($idno);
        $validatedData = $request->validate([
            'level' => '',
            'school_name' => '',
            'degree_course' => '',
            'period_of_attendance' => '',
            'year_graduated' => '',

        ]);

        $userEducation = UserEducation::where('idno', $idno)->firstOrFail();
        $userEducation->update($validatedData);
        return redirect()->route('education.index')->with('success', 'User education background saved successfully.');

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserEducation $userDetails)
    {
        //
    }
}
