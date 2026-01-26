<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Requests\StoreWorkDetailsRequest;
use App\Http\Requests\UpdateWorkDetailsRequest;
use App\Models\WorkDetails;

class WorkDetailsController extends Controller
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkDetailsRequest $request)
    {
        // dd($request->all());
        $idno = auth()->user()->idno;
        WorkDetails::create(array_merge($request->validated(), ['idno' => $idno]));
        return redirect()->route('exp.index')->with('success', 'Work details saved successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkDetailsRequest $request, $idno)
    {
        //dump and die request data for debugging
        // dd($request->all());
        // dd($idno);
        $validatedData = $request->validate([
            'professional_level' => '',
        ]);

        $professional_level = WorkDetails::where('idno', $idno)->firstOrFail();
        $professional_level->update($validatedData);
        return redirect()->route('job.index')->with('success', 'User details saved successfully.');

    }
    public function updates(UpdateWorkDetailsRequest $request, $idno)
    {
        $validatedData = $request->validate([
            'job_history' => '',
        ]);

        $job_history = WorkDetails::where('idno', $idno)->firstOrFail();
        $job_history->update($validatedData);
        return redirect()->route('expjob.index')->with('success', 'User details saved successfully.');

    }
    public function exp_job(UpdateWorkDetailsRequest $request, $idno)
    {
        $validatedData = $request->validate([
            'exploring_job' => '',
        ]);

        $professional_level = WorkDetails::where('idno', $idno)->firstOrFail();
        $professional_level->update($validatedData);
        return redirect()->route('distance.index')->with('success', 'User details saved successfully.');

    }
    public function distance_job(UpdateWorkDetailsRequest $request, $idno)
    {
        $validatedData = $request->validate([
            'distance_job' => '',
        ]);

        $distance_job = WorkDetails::where('idno', $idno)->firstOrFail();
        $distance_job->update($validatedData);
        return redirect()->route('roles.index')->with('success', 'User details saved successfully.');

    }

    public function job_roles(UpdateWorkDetailsRequest $request, $idno)
    {
        $validatedData = $request->validate([
            'job_roles' => '',
        ]);

        $job_roles = WorkDetails::where('idno', $idno)->firstOrFail();
        $job_roles->update($validatedData);
        return redirect()->route('shift.index')->with('success', 'User details saved successfully.');

    }

    public function job_shift(UpdateWorkDetailsRequest $request, $idno)
    {
        $validatedData = $request->validate([
            'job_shift' => '',
        ]);

        $job_roles = WorkDetails::where('idno', $idno)->firstOrFail();
        $job_roles->update($validatedData);
        return redirect()->route('shift.index')->with('success', 'User details saved successfully.');

    }
}
