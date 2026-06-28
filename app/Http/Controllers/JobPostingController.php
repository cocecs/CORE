<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\StoreJobPostingRequest;
use App\Http\Requests\UpdateJobPostingRequest;
use App\Models\JobPosting;
use App\Models\User;
use App\Models\Expertise;
use App\Models\JobApplication;

class JobPostingController extends Controller
{

    public function index()
    {
        $user = User::where('idno', auth()->user()->idno)->first();
        $expertise = Expertise::all();
        $jobs = JobPosting::where('idno', $user->idno)->latest()->get();

        // FIX: Redirect to the SHOW route, passing the 'code'
        return view('par.lj', compact('user', 'expertise', 'jobs'));
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
    public function emp_post()
    {
        $expertise = Expertise::all();
        $user = User::where('idno', auth()->user()->idno)->first();
        return view('par.post', compact('user', 'expertise'));
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
    public function parJobDetails($job_id)
    {
        $jobApp = JobApplication::where('job_id', $job_id)->count();
        $job = JobPosting::where('job_id', $job_id)->firstOrFail();
        return view('par.jd', compact('job','jobApp'));
    }
    public function parListApp($job_id)
    {
        $job = JobPosting::where('job_id', $job_id)->firstOrFail();
        $applicants = $job->applicants;
        return view('par.la', compact('job', 'applicants'));
    }
    public function parAppProfile($idno, $job_id)
    {
        // Queries the exact application instance using both identifier strings
        $application = JobApplication::with(['user.details'])
            ->where('user_id', $idno)
            ->where('job_id', $job_id)
            ->firstOrFail();

        $user = $application->user;
        $userDetails = $user->details;

        return view('par.app', compact('application', 'user', 'userDetails'));
    }
    public function addToInterviewList(Request $request, $job_id, $idno)
    {
        // Find the job to ensure it exists
        $job = JobPosting::where('job_id', $job_id)->firstOrFail();

        // Use syncWithoutDetaching to link them in the pivot table without creating duplicate records
        $job->interviewees()->syncWithoutDetaching([
            $idno => ['status' => 'interviewee']
        ]);

        return redirect()->back()->with('success', 'Applicant successfully added to the interview list!');
    }
    public function removeFromInterviewList($job_id, $idno)
    {
        $job = JobPosting::where('job_id', $job_id)->firstOrFail();

        // Detach removes the record matching this idno from the pivot table
        $job->interviewees()->detach($idno);

        return redirect()->back()->with('success', 'Applicant successfully removed from the interview list!');
    }
    public function hireApplicant($job_id, $idno)
    {
        $job = JobPosting::where('job_id', $job_id)->firstOrFail();

        // Updates the specific pivot row status field cleanly
        $job->interviewees()->updateExistingPivot($idno, [
            'status' => 'hired'
        ]);

        return redirect()->back()->with('success', 'Applicant status updated to Hired!');
    }
}
