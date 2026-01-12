<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetails;
use App\Http\Requests\StoreUserDetailsRequest;
use App\Http\Requests\UpdateUserDetailsRequest;
use App\Http\Requests\UpdateUserSexRequest;
use App\Http\Requests\UpdateUserAboutRequest;

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
        UserDetails::create($request->validated());
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
            'address' => '',
            'tel_no' => '',
            'mobile_no' => '',
            'sex' => '',
            'civil_status' => '',
        ]);

        $userAddress = UserDetails::where('idno', $idno)->firstOrFail();
        $userAddress->update($validatedData);
        return redirect()->route('sex.index')->with('success', 'User details saved successfully.');

    }
    public function updates(UpdateUserSexRequest $request, $idno)
    {
        //dump and die request data for debugging
        // dd($request->civil_status);
        // dd($idno);
        $validatedData = $request->validate([
            'sex' => 'required|string|max:255',
            'civil_status' => 'required|string|max:255',
        ]);

        $userAddress = UserDetails::where('idno', $idno)->firstOrFail();
        $userAddress->update($validatedData);
        return redirect()->route('about.index')->with('success', 'User detailssss saved successfully.');

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
        return redirect()->route('education.index')->with('success', 'User details saved successfully.');

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserDetails $userDetails)
    {
        //
    }
}
