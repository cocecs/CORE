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

        public function job_post(StoreJobPostingRequest $request)
        {
            $idno = auth()->user()->idno;

            // 1. Get the validated data from your request
            $validatedData = $request->validated();

            // 2. Look up the Town name using the submitted town ID
            $townRecord = \Illuminate\Support\Facades\DB::table('towns')
                ->where('id', $validatedData['town'] ?? null)
                ->select('town')
                ->first();

            // 3. Fetch the coordinates AND the barangay name from the barangays table
            $barangayRecord = \Illuminate\Support\Facades\DB::table('barangays')
                ->where('id', $validatedData['barangay'] ?? null)
                ->select('barangay', 'latitude', 'longitude')
                ->first();

            // 4. UPDATED: Fetch multiple course display names using the submitted course IDs array
            $courseIds = $validatedData['course_id'] ?? [];

            // Query all matching courses and pluck their display names
            $courseNames = \Illuminate\Support\Facades\DB::table('courses')
                ->whereIn('id', is_array($courseIds) ? $courseIds : [$courseIds])
                ->pluck('display_name')
                ->toArray();

            // 5. Overwrite the IDs with text names and merge everything into the final array
            $jobData = array_merge($validatedData, [
                'idno'      => $idno,
                'town'      => $townRecord ? $townRecord->town : null,
                'barangay'  => $barangayRecord ? $barangayRecord->barangay : null,
                'latitude'  => $barangayRecord ? $barangayRecord->latitude : null,
                'longitude' => $barangayRecord ? $barangayRecord->longitude : null,

                // Save the array of course names as a JSON string (recommended)
                // Alternatively, use: implode(', ', $courseNames) if you prefer a comma-separated string
                'course'    => !empty($courseNames) ? json_encode($courseNames) : null,
            ]);

            // 6. Create the Job Posting
            $job = JobPosting::create($jobData);

            return redirect()->route('emp_postc', ['job_id' => $job->job_id])
                            ->with('success', 'Job details, courses, location names, and coordinates saved successfully.');
        }

    public function getSkillsByExpertise($expertiseId)
    {
        // 1. Find the row matching the selected Area of Expertise ID
        $expertise = Expertise::find($expertiseId);

        if (!$expertise || empty($expertise->skills)) {
            return response()->json([]);
        }

        // 2. Turn the JSON array string ["skill1", "skill2"] into a clean PHP array
        // If your Expertise model already casts 'skills' to an array, you can skip json_decode
        $skillsArray = is_array($expertise->skills)
            ? $expertise->skills
            : json_decode($expertise->skills, true);

        // Safety fallback if JSON decoding fails
        if (!is_array($skillsArray)) {
            $skillsArray = array_map('trim', explode(',', $expertise->skills));
        }

        // 3. Return the clean array to your JavaScript fetch
        return response()->json(array_values($skillsArray));
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
