<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use App\Models\User;
use App\Http\Requests\StoreJobApplyRequest;
use App\Http\Requests\StoreJobSaveRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class JobRecommendationController extends Controller
{
    /**
     * Display the recommended job listings.
     */
    // public function index()
    // {
    //     // 1. Fetch the recommended jobs from the database
    //     // Adjust the query filters/ordering to match your actual requirements
    //     $jobs = JobPosting::where('is_active', true)
    //         ->latest()
    //         ->take(10) // Limit for UI performance
    //         ->get();

    //     // 2. Dynamically inject the "is_new" logic if it's not a database column
    //     // For example, marking jobs posted within the last 48 hours as "New to you"
    //     $jobs->transform(function ($job) {
    //         $job->is_new = $job->created_at->greaterThanOrEqualTo(Carbon::now()->subHours(48));
    //         return $job;
    //     });

    //     // 3. Pass the data to your blade view
    //     return view('rec', compact('jobs'));
    // }

    public function index()
    {
        // 1. Fetch user details directly using the 'idno' column
        $applicant = \App\Models\UserDetails::where('idno', Auth::user()->idno)->first();
        $workDetail = \App\Models\WorkDetails::where('idno', Auth::user()->idno)->first();

        // 1. Safety Check: If the user hasn't filled out their address profile yet
        if (!$applicant) {
            return redirect()->route('sex.index')
                ->with('error', 'Please complete your profile and address details first.');
        }

        // 2. NEW Safety Check: If the user hasn't filled out their work details/skills yet
        if (!$workDetail) {
            return redirect()->route('background.index')
                ->with('error', 'Please complete your work experience and skills profile first.');
        }

        // 3. Safety Check: If they have a profile record but no coordinates have been saved yet
        if (is_null($applicant->latitude) || is_null($applicant->longitude)) {
            return redirect()->route('sex.index')
                ->with('error', 'Please update your address to set your location coordinates.');
        }

        // 4. Set the variables for the geospatial query below
        $applicantLat = $applicant->latitude;
        $applicantLng = $applicant->longitude;

        // This is now safe from throwing a "null" exception!
        $preferredSkills = $workDetail->skills;

        // Maximum radius allowed for the recommendation (e.g., 15 kilometers)
        $maxDistanceKm = 15;

        // 2. Query Job Postings using Geospatial & Knowledge-Based Filters
        // Ensure $preferredSkills is treated as an array
        $skillsArray = is_array($preferredSkills) ? $preferredSkills : json_decode($preferredSkills, true) ?? [];

        $jobs = JobPosting::select('*')
            ->selectRaw("
                ( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) )
                * cos( radians( longitude ) - radians(?) ) + sin( radians(?) )
                * sin( radians( latitude ) ) ) ) AS distance
            ", [$applicantLat, $applicantLng, $applicantLat])

            // Knowledge-Based Filter: Match if the job requires ANY of the user's skills
            ->where(function ($query) use ($skillsArray) {
                foreach ($skillsArray as $skill) {
                    $query->orWhere('skills_required', 'LIKE', '%' . $skill . '%');
                }
            })

            ->having('distance', '<=', $maxDistanceKm)
            ->orderBy('distance', 'asc')
            ->get();

        // 3. Pass the filtered jobs to the Blade view
        return view('rec', compact('jobs', 'maxDistanceKm'));
    }
    public function details($job_id)
    {
        // Fetch the job details, or return a 404 page if the job ID doesn't exist
        $job = JobPosting::where('job_id', $job_id)->firstOrFail();

        // Return the full details view with the job data
        return view('recd', compact('job'));
    }
    /**
     * Handle the user applying for/saving a job.
     */
    public function apply(StoreJobApplyRequest $request, $jobId)
    {
        // 1. Fetch the job posting using your custom unique 'job_id' column
        $job = JobPosting::where('job_id', $jobId)->firstOrFail();
        $user = Auth::user();

        // 2. Check the job_applications table directly using appliedJobs()
        $alreadyApplied = $user->appliedJobs()
            ->where('job_applications.job_id', $jobId)
            ->exists();

        if ($alreadyApplied) {
            return redirect()->back()->with('info', 'You have already applied for this job.');
        }

        // 3. Attach the record to the job_applications pivot table
        // Use $job->job_id to match your database column name property
        $user->appliedJobs()->syncWithoutDetaching([$job->job_id => ['status' => 'applied']]);

        // 4. Typically, you want to redirect back with flash messages instead of returning a view directly.
        // This allows the page to refresh cleanly and show your Tailwind alerts.

        return view('recd', compact('job'));
        // return redirect()->back()->with('success', 'Application submitted successfully!');
    }

    /**
     * Toggle the "Save Job" state (Save / Unsave).
     */
    public function toggleSave(StoreJobSaveRequest $request, $job_id)
    {
        // Find the job using the ID passed from the route
        $job = JobPosting::where('job_id', $job_id)->firstOrFail();

        $user = Auth::user();

        // Check using the true primary key 'id'
        $isSaved = $user->savedJobs()->where('job_saves.job_id', $job->job_id)->exists();

        if ($isSaved) {
            // Detach using the true primary key 'id'
            $user->savedJobs()->detach($job->job_id);
            return redirect()->back()->with('success', 'Job removed from your saved list.');
        }

        // Attach using the true primary key 'id'
        // This inserts the actual database primary key ($job->id) into job_saves.job_id
        $user->savedJobs()->attach($job->job_id, ['status' => 'saved']);

        return redirect()->back()->with('success', 'Job saved successfully!');
    }

    public function cancel(StoreJobApplyRequest $request, $job_id)
    {
        $user = Auth::user();

        // Detach the job to cancel the application
        $user->appliedJobs()->detach($job_id);

        return redirect()->back()->with('success', 'Application withdrawn successfully.');
    }

    public function profile_review($job_id)
    {
        $job = JobPosting::where('job_id', $job_id)->firstOrFail();
        $user = Auth::user();
        return view('recp', compact('user', 'job'));
    }
}
