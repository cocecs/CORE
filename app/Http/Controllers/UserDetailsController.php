<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetails;
use App\Http\Requests\StoreUserDetailsRequest;
use App\Http\Requests\UpdateUserDetailsRequest;
use App\Http\Requests\UpdateUserSexRequest;
use App\Http\Requests\UpdateUserGenderRequest;
use App\Http\Requests\UpdateUserAboutRequest;
use App\Http\Requests\UpdateUserCivilRequest;
use App\Http\Requests\UpdateUserCourseRequest;

class UserDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('email', auth()->user()->email)->first();
        return view('user.details', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.details');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserDetailsRequest $request)
    {
        $user = User::where('email', auth()->user()->email)->first();
        UserDetails::create(array_merge($request->validated(), [
            'idno' => $user->idno,
        ]));

        return redirect()->route('address.index')->with('success', 'User details saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserDetails $userDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserDetails $userDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserDetailsRequest $request, $idno)
    {
        //dump and die request data for debugging
        // dd($request->civil_status);
        // dd($idno);
        $validatedData = $request->validate([
            'province' => '',
            'town' => '',
            'brgy' => '',
            'address' => '',
        ]);


        $userAddress = UserDetails::where('idno', $idno)->firstOrFail();
        $userAddress->update($validatedData);
        return redirect()->route('sex.index')->with('success', 'User details saved successfully.');

    }
    public function updatesex(UpdateUserSexRequest $request, $idno)
    {
        $validatedData = $request->validate([
            'sex' => 'required|string|max:1',
        ]);

        $userAddress = UserDetails::where('idno', $idno)->firstOrFail();
        $userAddress->update($validatedData);
        return redirect()->route('gender.index')->with('success', 'User details saved successfully.');

    }
    public function updateGender(UpdateUserGenderRequest $request, $idno)
    {
        if ($request->filled('custom_gender')) {
            $request->merge(['gender' => $request->custom_gender]);
        }

        $validatedData = $request->validate([
            'gender' => 'required|string|max:15',
        ]);

        $userAddress = UserDetails::where('idno', $idno)->firstOrFail();
        $userAddress->update($validatedData);
        return redirect()->route('civil.index')->with('success', 'User details saved successfully.');

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

        return redirect()->route('expertise.process')->with('success', 'User details saved successfully.');
    }
    public function updateCivil(UpdateUserCivilRequest $request, $idno)
    {
        //dump and die request data for debugging
        // dd($request->civil_status);
        // dd($idno);
        $validatedData = $request->validate([
            'civil_status' => 'required|string|max:15',
        ]);

        $userDetail = UserDetails::where('idno', $idno)->firstOrFail();
        $userDetail->update($validatedData);
        return redirect()->route('background.index')->with('success', 'User details saved successfully.');

    }
    public function updateAbout(UpdateUserAboutRequest $request, $idno)
    {
        //dump and die request data for debugging
        // dd($request->about_me);
        // dd($idno);
        $validatedData = $request->validate([
            'about_me' => 'required|string|max:255',
        ]);

        $userAddress = UserDetails::where('idno', $idno)->firstOrFail();
        $userAddress->update($validatedData);
        return redirect()->route('background.index')->with('success', 'User details saved successfully.');

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserDetails $userDetails)
    {
        //
    }
}
