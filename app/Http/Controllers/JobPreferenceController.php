<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobPreferenceRequest;
use App\Http\Requests\UpdateJobPreferenceRequest;
use App\Models\User;
use App\Models\JobPreference;

class JobPreferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('idno', auth()->user()->idno)->first();
        return view('job.prefocc', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function prefocc(StoreJobPreferenceRequest $request)
    {
        $idno = auth()->user()->idno;
        JobPreference::create(array_merge($request->validated(), ['idno' => $idno]));
        return redirect()->route('distance.index')->with('success', 'Job preference saved successfully.');
    }
    public function distance()
    {
        $user = User::where('idno', auth()->user()->idno)->first();
        return view('job.distance', compact('user'));
    }
    public function work_location(UpdateJobPreferenceRequest $request, $idno)
    {
        $validatedData = $request->validate([
            'work_location' => '',
            'specific_location' => '',
            'specify_country' => '',
        ]);

        $work_location = JobPreference::where('idno', $idno)->firstOrFail();
        $work_location->update($validatedData);
        return redirect()->route('distance.index')->with('success', 'User details saved successfully.');

    }

}
