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
        $idno = auth()->user()->idno;
        WorkDetails::create(array_merge($request->validated(), ['idno' => $idno]));
        return redirect()->route('professional.index')->with('success', 'Work details saved successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkDetailsRequest $request, $idno)
    {
        // $validatedData = $request->validate([
        //     'professional_level' => '',
        // ]);

        $validatedData = $request->validated();
        $professional_level = WorkDetails::where('idno', $idno)->firstOrFail();
        $professional_level->update($validatedData);
        return redirect()->route('status.index')->with('success', 'User details saved successfully.');

    }
    public function updates(UpdateWorkDetailsRequest $request, $idno)
    {
        // $validatedData = $request->validate([
        //     'job_history' => '',
        // ]);

        $validatedData = $request->validated();
        $job_history = WorkDetails::where('idno', $idno)->firstOrFail();
        $job_history->update($validatedData);
        return redirect()->route('expjob.index')->with('success', 'User details saved successfully.');

    }
    public function exp_job(UpdateWorkDetailsRequest $request, $idno)
    {
        // $validatedData = $request->validate([
        //     'exploring_job' => 'array',
        // ]);

        $validatedData = $request->validated();
        $professional_level = WorkDetails::where('idno', $idno)->firstOrFail();
        $professional_level->update($validatedData);
        return redirect()->route('distance.index')->with('success', 'User details saved successfully.');

    }
    public function distance_job(UpdateWorkDetailsRequest $request, $idno)
    {
        // $validatedData = $request->validate([
        //     'distance_job' => '',
        // ]);

        $validatedData = $request->validated();
        $distance_job = WorkDetails::where('idno', $idno)->firstOrFail();
        $distance_job->update($validatedData);
        return redirect()->route('roles.index')->with('success', 'User details saved successfully.');

    }

    public function job_roles(UpdateWorkDetailsRequest $request, $idno)
    {
        // $validatedData = $request->validate([
        //     'job_roles' => '',
        // ]);

        $validatedData = $request->validated();
        $job_roles = WorkDetails::where('idno', $idno)->firstOrFail();
        $job_roles->update($validatedData);
        return redirect()->route('shift.index')->with('success', 'User details saved successfully.');

    }

    public function job_shift(UpdateWorkDetailsRequest $request, $idno)
    {
        // $validatedData = $request->validate([
        //     'job_shift' => 'array',
        // ]);

        $validatedData = $request->validated();
        $job_roles = WorkDetails::where('idno', $idno)->firstOrFail();
        $job_roles->update($validatedData);
        return redirect()->route('expertise.index')->with('success', 'User details saved successfully.');

    }

    public function expertise(UpdateWorkDetailsRequest $request, $idno)
    {
        // $validatedData = $request->validate([
        //     'expertise' => '',
        // ]);

        $validatedData = $request->validated();
        $expertise = WorkDetails::where('idno', $idno)->firstOrFail();
        $expertise->update($validatedData);
        return redirect()->route('expertise.index')->with('success', 'User details saved successfully.');

    }
    public function employ_status(UpdateWorkDetailsRequest $request, $idno)
    {
        // $validatedData = $request->validate([
        //     'employment_status' => '',
        //     'employment_type' => '',
        //     // 'self_employed_spec' => 'array',
        //     'self_employed_spec' => '',
        //     'others_specify' => '',
        //     'job_history' => '',
        // ]);

        $validatedData = $request->validated();
        if ($validatedData['employment_type'] === '1' || $validatedData['employment_status'] === '0')
        {
            $validatedData['self_employed_spec'] = null; // Or [] if you prefer empty array
            $validatedData['job_history'] = null;
        }

        $expertise = WorkDetails::where('idno', $idno)->firstOrFail();
        $expertise->update($validatedData);

        if ($validatedData['employment_status'] == '1') {
            return redirect()->route('ofw.index')->with('success', 'User details saved successfully.');
        } else {
            return redirect()->route('employment.index')->with('success', 'User details saved successfully.');
        }
    }
    public function unemployment(UpdateWorkDetailsRequest $request, $idno)
    {
        // $validatedData = $request->validate([
        //     'job_history' => '',
        //     'specify_country' => '',
        //     'other_specify' => '',
        // ]);

        $validatedData = $request->validated();
        $unemployment = WorkDetails::where('idno', $idno)->firstOrFail();
        $unemployment->update($validatedData);
        return redirect()->route('ofw.index')->with('success', 'User details saved successfully.');

    }
    public function ofw_update(UpdateWorkDetailsRequest $request, $idno)
    {
        // $validatedData = $request->validate([
        //     'ofw' => '',
        //     'ofw_specify_country' => '',
        //     'latest_specify_country' => '',
        //     'month_year_return' => '',
        // ]);

        $validatedData = $request->validated();
        $ofw = WorkDetails::where('idno', $idno)->firstOrFail();
        $ofw->update($validatedData);
        return redirect()->route('fourps.index')->with('success', 'User details saved successfully.');

    }
    public function fourps(UpdateWorkDetailsRequest $request, $idno)
    {
        // $validatedData = $request->validate([
        //     'fourps' => '',
        //     'fourps_houshold_id' => '',
        // ]);

        $validatedData = $request->validated();
        $fourps = WorkDetails::where('idno', $idno)->firstOrFail();
        $fourps->update($validatedData);
        return redirect()->route('prefocc.index')->with('success', 'User details saved successfully.');

    }
}
