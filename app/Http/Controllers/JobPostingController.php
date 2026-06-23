<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobPostingRequest;
use App\Http\Requests\UpdateJobPostingRequest;
use App\Models\JobPosting;
use App\Models\User;
use App\Models\Expertise;

class JobPostingController extends Controller
{

    public function index()
    {
        $user = User::where('idno', auth()->user()->idno)->first();
        $expertise = Expertise::all();

        // FIX: Redirect to the SHOW route, passing the 'code'
        return view('par.post', compact('user', 'expertise'));
    }
    // public function job_post(StoreJobPostingRequest $request)
    // {
    //     $idno = auth()->user()->idno;
    //     $job =JobPosting::create(array_merge($request->validated(), ['idno' => $idno]));
    //     // return redirect()->action([self::class, 'emp_post'])->with('success', 'Job posting saved successfully.');

    //     return redirect()->route('emp_postc', ['job_id' => $job->job_id])
    //                  ->with('success', 'Job details saved successfully.');
    // }

    public function job_post(StoreJobPostingRequest $request)
    {
        $idno = auth()->user()->idno;

        // 1. Get the validated data from your request
        $validatedData = $request->validated();

        // 2. Fetch the coordinates from the barangays table using the submitted 'brgy' field
        // Note: If your table name is singular, change 'barangays' to 'barangay'
        $barangayCoordinates = \Illuminate\Support\Facades\DB::table('barangays')
            ->where('id', $validatedData['barangay'] ?? null)
            ->select('latitude', 'longitude')
            ->first();

        // 3. Merge coordinates and the user's idno into the final insertion array
        $jobData = array_merge($validatedData, [
            'idno' => $idno,
            'latitude' => $barangayCoordinates ? $barangayCoordinates->latitude : null,
            'longitude' => $barangayCoordinates ? $barangayCoordinates->longitude : null,
        ]);

        // 4. Create the Job Posting
        $job = JobPosting::create($jobData);

        return redirect()->route('emp_postc', ['job_id' => $job->job_id])
                        ->with('success', 'Job details and coordinates saved successfully.');
    }

    public function getSkillsByExpertise($expertiseId)
    {
        // 1. Find the row matching the selected Area of Expertise ID
        $expertise = Expertise::find($expertiseId);

        if (!$expertise || empty($expertise->skills)) {
            return response()->json([]);
        }

        // 2. Turn "Skill A, Skill B, Skill C" into ['Skill A', 'Skill B', 'Skill C']
        $skillsArray = array_map('trim', explode(',', $expertise->skills));

        // 3. Return the clean array to your JavaScript fetch
        return response()->json($skillsArray);
    }
    public function emp_postc($job_id)
    {
        $job = JobPosting::where('job_id', $job_id)->firstOrFail();

        // Pass it to the view
        return view('par.postc', compact('job_id'));
    }
    public function job_postc(UpdateJobPostingRequest $request, $job_id)
    {
        $validatedData = $request->validated();

        $jobdetails = JobPosting::where('job_id', $job_id)->firstOrFail();
        $jobdetails->update($validatedData);

        return redirect()->route('emp_postc', ['job_id' => $job_id])
                 ->with('success', 'User details saved successfully.');
    }
    public function list_jobPosted()
    {
        $idno = auth()->user()->idno;
        $jobs = JobPosting::where('idno', $idno)->latest()->get();
        return view('par.lj', compact('jobs'));
    }
}
