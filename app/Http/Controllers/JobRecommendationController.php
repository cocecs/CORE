<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use App\Models\Expertise;
use App\Http\Requests\StoreJobApplyRequest;
use App\Http\Requests\StoreJobSaveRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class JobRecommendationController extends Controller
{
    /**
     * Display the recommended job listings.
     */

    // public function index(Request $request)
    // {
    //     // 1. Fetch user and validation checks
    //     $applicant = \App\Models\UserDetails::where('idno', Auth::user()->idno)->first();
    //     $workDetail = \App\Models\WorkDetails::where('idno', Auth::user()->idno)->first();
    //     $jobPreference = \App\Models\JobPreference::where('idno', Auth::user()->idno)->first();

    //     if (!$applicant) {
    //         return redirect()->route('address.index')->with('error', 'Please complete your profile first.');
    //     }
    //     if (!$workDetail) {
    //         return redirect()->route('background.index')->with('error', 'Please complete your skills profile first.');
    //     }
    //     if (is_null($jobPreference->latitude) || is_null($jobPreference->longitude)) {
    //         return redirect()->route('distance.index')->with('error', 'Please update your coordinates.');
    //     }

    //     $applicantLat = $jobPreference->latitude;
    //     $applicantLng = $jobPreference->longitude;

    //     $showAll = $request->has('show_all');
    //     $isSearching = $request->hasAny(['job_type', 'job_category', 'province', 'town']);
    //     $maxDistanceKm = 100;

    //     // 2. Start Base Query (Location & Distance)
    //     $query = JobPosting::select('job_postings.*', 'expertises.area_of_expertise')
    //         ->join('expertises', 'job_postings.job_category', '=', 'expertises.id')
    //         ->selectRaw("
    //             ( 6371 * acos( cos( radians(?) ) * cos( radians( job_postings.latitude ) )
    //             * cos( radians( job_postings.longitude ) - radians(?) ) + sin( radians(?) )
    //             * sin( radians( job_postings.latitude ) ) ) ) AS distance
    //         ", [$applicantLat, $applicantLng, $applicantLat]);

    //     // 3. APPLY FILTERS (If user is explicitly searching or if query parameters are set)
    //     if ($request->filled('job_type')) {
    //         $query->where('job_postings.job_type', $request->input('job_type'));
    //     }
    //     if ($request->filled('job_category')) {
    //         $query->where('job_postings.job_category', $request->input('job_category'));
    //     }
    //     if ($request->filled('province')) {
    //         $query->where('job_postings.province', $request->input('province'));
    //     }
    //     if ($request->filled('town')) {
    //         $query->where('job_postings.town', $request->input('town'));
    //     }

    //     // 4. APPLY SKILLS MATCHING (Only on standard load: NOT when searching and NOT when showing all)
    //     if (!$showAll && !$isSearching) {
    //         $preferredSkills = $workDetail->skills;
    //         $skillsArray = is_array($preferredSkills) ? $preferredSkills : json_decode($preferredSkills, true) ?? [];

    //         if (!empty($skillsArray)) {
    //             $query->where(function ($q) use ($skillsArray) {
    //                 foreach ($skillsArray as $skill) {
    //                     $q->orWhere('job_postings.skills_required', 'LIKE', '%' . $skill . '%');
    //                 }
    //             });
    //         }
    //     }

    //     // 5. DISTANCE CONSTRAINT BYPASS
    //     if (!$showAll && !$isSearching) {
    //         $query->having('distance', '<=', $maxDistanceKm);
    //     } else {
    //         $maxDistanceKm = null; // Set to null for subheader display compatibility
    //     }

    //     // 6. Finalize Results
    //     $jobs = $query->orderBy('distance', 'asc')->get();
    //     $expertise = Expertise::all();

    //     return view('rec', compact('jobs', 'maxDistanceKm', 'expertise'));
    // }
    public function index(Request $request)
    {
        // 1. Fetch user and validation checks
        $applicant = \App\Models\UserDetails::where('idno', Auth::user()->idno)->first();
        $workDetail = \App\Models\WorkDetails::where('idno', Auth::user()->idno)->first();
        $jobPreference = \App\Models\JobPreference::where('idno', Auth::user()->idno)->first();

        if (!$applicant) {
            return redirect()->route('address.index')->with('error', 'Please complete your profile first.');
        }
        if (!$workDetail) {
            return redirect()->route('background.index')->with('error', 'Please complete your skills profile first.');
        }
        if (is_null($jobPreference->latitude) || is_null($jobPreference->longitude)) {
            return redirect()->route('distance.index')->with('error', 'Please update your coordinates.');
        }

        $applicantLat = $jobPreference->latitude;
        $applicantLng = $jobPreference->longitude;

        $showAll = $request->has('show_all');
        // Modify isSearching to ensure it's ignored if "Show All" is explicitly clicked
        $isSearching = !$showAll && $request->hasAny(['job_type', 'job_category', 'province', 'town']);

        // 2. Start Base Query (Location & Proximity Calculation)
        $query = JobPosting::select('job_postings.*', 'expertises.area_of_expertise')
            ->join('expertises', 'job_postings.job_category', '=', 'expertises.id')
            ->selectRaw("
                ( 6371 * acos( cos( radians(?) ) * cos( radians( job_postings.latitude ) )
                * cos( radians( job_postings.longitude ) - radians(?) ) + sin( radians(?) )
                * sin( radians( job_postings.latitude ) ) ) ) AS distance
            ", [$applicantLat, $applicantLng, $applicantLat]);

        // 3. APPLY FILTERS (Skipped completely if $showAll is true)
        if (!$showAll) {
            if ($request->filled('job_type')) {
                $query->where('job_postings.job_type', $request->input('job_type'));
            }
            if ($request->filled('job_category')) {
                $query->where('job_postings.job_category', $request->input('job_category'));
            }
            if ($request->filled('province')) {
                $query->where('job_postings.province', $request->input('province'));
            }
            if ($request->filled('town')) {
                $query->where('job_postings.town', $request->input('town'));
            }
        }

        // 4. APPLY SKILLS MATCHING (Only on standard load: NOT when searching and NOT when showing all)
        if (!$showAll && !$isSearching) {
            $preferredSkills = $workDetail->skills;
            $skillsArray = is_array($preferredSkills) ? $preferredSkills : json_decode($preferredSkills, true) ?? [];

            if (!empty($skillsArray)) {
                $query->where(function ($q) use ($skillsArray) {
                    foreach ($skillsArray as $skill) {
                        $q->orWhere('job_postings.skills_required', 'LIKE', '%' . $skill . '%');
                    }
                });
            }
        }

        // 5. Finalize Results (Sorted by closest distance)
        $jobs = $query->orderBy('distance', 'asc')->get();
        $expertise = \App\Models\Expertise::all(); // Added fallback full namespace if not imported

        return view('rec', compact('jobs', 'expertise'));
    }
    public function details($job_id)
    {
        // 1. Fetch user details to get their latitude and longitude coordinates
        $applicant = \App\Models\UserDetails::where('idno', Auth::user()->idno)->first();
        $jobPreference = \App\Models\JobPreference::where('idno', Auth::user()->idno)->first();

        // Set fallback coordinates if the user profile doesn't exist to avoid breaks
        $applicantLat = $jobPreference->latitude;
        $applicantLng = $jobPreference->longitude;
        // 2. Fetch the job details while calculating the distance on the fly
        $job = JobPosting::select('job_postings.*', 'expertises.area_of_expertise')
            ->join('expertises', 'job_postings.job_category', '=', 'expertises.id')
            ->selectRaw("
                ( 6371 * acos( cos( radians(?) ) * cos( radians( job_postings.latitude ) )
                * cos( radians( job_postings.longitude ) - radians(?) ) + sin( radians(?) )
                * sin( radians( job_postings.latitude ) ) ) ) AS distance
            ", [$applicantLat, $applicantLng, $applicantLat])
            ->where('job_postings.job_id', $job_id)
            ->firstOrFail();

        // Return the full details view with the computed job data
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
