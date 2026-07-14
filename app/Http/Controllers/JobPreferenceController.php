<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobPreferenceRequest;
use App\Http\Requests\UpdateJobPreferenceRequest;
use App\Models\User;
use App\Models\JobPreference;
use Illuminate\Support\Facades\DB;

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
        // without coordinates
        // $validatedData = $request->validated();
        // $work_location = JobPreference::where('idno', $idno)->firstOrFail();
        // $work_location->update($validatedData);
        // return redirect()->route('recommended')->with('success', 'User details saved successfully.');

        //with coordinates
        $validatedData = $request->validated();
        $jobPreference = JobPreference::where('idno', $idno)->firstOrFail();
        $jobPreference->fill($validatedData);

        // --- DEBUGGING BLOCK ---
        // If it stops here, look at what 'work_location' and 'town' are actually sending
        // dd($request->input('work_location'), $request->input('town'));
        // -----------------------

        if ($request->input('work_location') == '1' && $request->filled('town')) {

            // Find the town matching the ID sent from the dropdown
            $townCoordinate = DB::table('towns')
                ->where('id', $request->input('town')) // <-- Ensure 'id' is the primary key column in your towns table
                ->select('latitude', 'longitude')
                ->first();

            // --- DEBUGGING BLOCK ---
            // If this displays 'null', it means your 'towns' table doesn't have a row matching that town ID,
            // or the column names ('latitude' / 'longitude') inside the 'towns' table are named differently.
            // dd($townCoordinate);
            // -----------------------

            if ($townCoordinate) {
                $jobPreference->latitude = $townCoordinate->latitude;
                $jobPreference->longitude = $townCoordinate->longitude;
            }
        } else {
            $jobPreference->latitude = null;
            $jobPreference->longitude = null;
        }

        $jobPreference->save();

        return redirect()->route('recommended')->with('success', 'User details saved successfully.');
    }
    public function current_school()
    {
        $user = User::where('idno', auth()->user()->idno)->first();
        // return view('education.currently-in-school', compact('user'));
    }

}
