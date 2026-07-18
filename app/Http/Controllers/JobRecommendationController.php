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

    //     // Fetch educational profile to retrieve course fields
    //     $educational = \Illuminate\Support\Facades\DB::table('educationals')
    //         ->where('idno', Auth::user()->idno)
    //         ->first();

    //     if (!$applicant) {
    //         return redirect()->route('address.index')->with('error', 'Please complete your profile first.');
    //     }
    //     if (!$educational) {
    //         return redirect()->route('background.index')->with('error', 'Please complete your educational profile first.');
    //     }
    //     if (!$workDetail) {
    //         return redirect()->route('expertise.process')->with('error', 'Please complete your skills profile first.');
    //     }
    //     if (is_null($workDetail->latitude) || is_null($workDetail->longitude)) {
    //         return redirect()->route('distance.index')->with('error', 'Please update your coordinates.');
    //     }

    //     $applicantLat = $workDetail->latitude;
    //     $applicantLng = $workDetail->longitude;

    //     $showAll = $request->has('show_all');

    //     // Check if the user is actively using the search/filter form
    //     $isSearching = !$showAll && $request->hasAny(['job_type', 'course', 'province', 'town']);

    //     // 2. Start Base Query (Location & Proximity Calculation)
    //     $query = JobPosting::select('job_postings.*')
    //         ->selectRaw("
    //             ( 6371 * acos( cos( radians(?) ) * cos( radians( job_postings.latitude ) )
    //             * cos( radians( job_postings.longitude ) - radians(?) ) + sin( radians(?) )
    //             * sin( radians( job_postings.latitude ) ) ) ) AS distance
    //         ", [$applicantLat, $applicantLng, $applicantLat]);

    //     // 3. APPLY FILTERS (Active Search Mode)
    //     if (!$showAll && $isSearching) {
    //         if ($request->filled('job_type')) {
    //             $query->where('job_postings.job_type', $request->input('job_type'));
    //         }
    //         if ($request->filled('course')) {
    //             // Updated to search within JSON array structure using LIKE
    //             $searchCourse = $request->input('course');
    //             $query->where('job_postings.course', 'LIKE', '%' . $searchCourse . '%');
    //         }
    //         if ($request->filled('province')) {
    //             $query->where('job_postings.province', $request->input('province'));
    //         }
    //         if ($request->filled('town')) {
    //             $query->where('job_postings.town', $request->input('town'));
    //         }
    //     }

    //     // 4. APPLY AUTOMATIC MATCHING (Standard Load Mode - when NOT searching and NOT showing all)
    //     if (!$showAll && !$isSearching) {
    //         // A. STRICT COURSE FILTERING (Match array to array)
    //         // Collect all non-null courses from the applicant's educational profile
    //         $applicantCourses = array_filter([
    //             $educational->vocational_course ?? null,
    //             $educational->course_degree ?? null,
    //             $educational->postgrad_course_degree ?? null,
    //             $educational->doctoral_course_degree ?? null
    //         ]);

    //         // Clean values: trim whitespaces and remove duplicates
    //         $applicantCourses = array_unique(array_filter(array_map('trim', $applicantCourses)));

    //         // Strict: Only display jobs where the job's course array matches one of the applicant's courses
    //         if (!empty($applicantCourses)) {
    //             $query->where(function ($q) use ($applicantCourses) {
    //                 foreach ($applicantCourses as $course) {
    //                     // Since job_postings.course is stored as a JSON array (e.g. ["Course A", "Course B"]),
    //                     // using 'LIKE' finds the exact course name wrapped within the JSON string.
    //                     $q->orWhere('job_postings.course', 'LIKE', '%' . $course . '%');
    //                 }
    //             });
    //         } else {
    //             // Optional fallback: If applicant has no courses filled, return nothing on strict load to maintain logic
    //             $query->whereRaw('1 = 0');
    //         }
    //     }

    //     // 5. Finalize Results (Strictly sorted by closest distance)
    //     $jobs = $query->orderBy('distance', 'asc')->get();
    //     $expertise = \App\Models\Expertise::all();
    //     $courses = \Illuminate\Support\Facades\DB::table('courses')->select('display_name')->distinct()->get();

    //     return view('rec', compact('jobs', 'courses', 'expertise'));
    // }
    public function index(Request $request)
    {
        // 1. Fetch user and validation checks
        $applicant = \App\Models\UserDetails::where('idno', Auth::user()->idno)->first();
        $workDetail = \App\Models\WorkDetails::where('idno', Auth::user()->idno)->first();
        $jobPreference = \App\Models\JobPreference::where('idno', Auth::user()->idno)->first();

        // Fetch educational profile to retrieve course fields
        $educational = \Illuminate\Support\Facades\DB::table('educationals')
            ->where('idno', Auth::user()->idno)
            ->first();

        if (!$applicant) {
            return redirect()->route('address.index')->with('error', 'Please complete your profile first.');
        }
        if (!$educational) {
            return redirect()->route('background.index')->with('error', 'Please complete your educational profile first.');
        }
        if (!$workDetail) {
            return redirect()->route('expertise.process')->with('error', 'Please complete your skills profile first.');
        }
        if (is_null($workDetail->latitude) || is_null($workDetail->longitude)) {
            return redirect()->route('distance.index')->with('error', 'Please update your coordinates.');
        }

        $applicantLat = $workDetail->latitude;
        $applicantLng = $workDetail->longitude;
        $showAll = $request->has('show_all');
        $isSearching = !$showAll && $request->hasAny(['job_type', 'course', 'province', 'town']);

        // ====================================================
        // PIPELINE 1 (RED SECTION): PROFILE & GEOSPATIAL MATRIX
        // ====================================================
        $query = JobPosting::select('job_postings.*')
            ->selectRaw("
                ( 6371 * acos( cos( radians(?) ) * cos( radians( job_postings.latitude ) )
                * cos( radians( job_postings.longitude ) - radians(?) ) + sin( radians(?) )
                * sin( radians( job_postings.latitude ) ) ) ) AS distance
            ", [$applicantLat, $applicantLng, $applicantLat]);

        // Apply Active Filters (Search Mode Override)
        if (!$showAll && $isSearching) {
            if ($request->filled('job_type')) {
                $query->where('job_postings.job_type', $request->input('job_type'));
            }
            if ($request->filled('course')) {
                $searchCourse = $request->input('course');
                $query->where('job_postings.course', 'LIKE', '%' . $searchCourse . '%');
            }
            if ($request->filled('province')) {
                $query->where('job_postings.province', $request->input('province'));
            }
            if ($request->filled('town')) {
                $query->where('job_postings.town', $request->input('town'));
            }
        }

        // Apply Automatic Content Matching (Standard Load Mode)
        if (!$showAll && !$isSearching) {
            $applicantCourses = array_filter([
                $educational->vocational_course ?? null,
                $educational->course_degree ?? null,
                $educational->postgrad_course_degree ?? null,
                $educational->doctoral_course_degree ?? null
            ]);

            $applicantCourses = array_unique(array_filter(array_map('trim', $applicantCourses)));

            if (!empty($applicantCourses)) {
                $query->where(function ($q) use ($applicantCourses) {
                    foreach ($applicantCourses as $course) {
                        $q->orWhere('job_postings.course', 'LIKE', '%' . $course . '%');
                    }
                });
            } else {
                $query->whereRaw('1 = 0'); // Fallback sequence logic protection
            }
        }

        // Fetch Content-Geospatial Result Pipeline
        $profileMatchedJobs = $query->orderBy('distance', 'asc')->get();


        // ====================================================
        // PIPELINE 2 (GREEN SECTION): COLLABORATIVE FILTERING
        // ====================================================
        $collaborativeJobs = collect();
        $userIdno = Auth::user()->idno; // Pulling idno tracking parameter string matching schema mappings

        // Step A: Capture explicit interaction arrays left behind by current user
        $savedJobIds = DB::table('job_saves')->where('user_id', $userIdno)->pluck('job_id')->toArray();
        $interviewJobIds = DB::table('job_interviewees')->where('user_id', $userIdno)->pluck('job_id')->toArray();
        $appliedJobIds = DB::table('job_applications')->where('user_id', $userIdno)->pluck('job_id')->toArray();

        $userHistoryJobIds = array_unique(array_merge($savedJobIds, $interviewJobIds, $appliedJobIds));

        if (!empty($userHistoryJobIds)) {
            // Step B: Form dynamic collaborative tracking table via UNION strings
            // explicit interaction scoring configurations (+1 Save, +3 Interview, +5 Application/Hired)
            $unifiedInteractions = DB::table('job_saves')
                ->select('user_id', 'job_id', DB::raw('1 as score'))
                ->unionAll(
                    DB::table('job_interviewees')->select('user_id', 'job_id', DB::raw('3 as score'))
                )
                ->unionAll(
                    DB::table('job_applications')->select('user_id', 'job_id', DB::raw('5 as score'))
                );

            // Step C: Run inner co-occurrence query matrix comparing interaction tracks
            $recommendedItemScores = DB::table(DB::raw("({$unifiedInteractions->toSql()}) as target_history"))
                ->mergeBindings($unifiedInteractions)
                ->join(DB::raw("({$unifiedInteractions->toSql()}) as peer_history"), 'target_history.user_id', '=', 'peer_history.user_id')
                ->mergeBindings($unifiedInteractions)
                ->select('peer_history.job_id', DB::raw('SUM(peer_history.score) as co_occurrence_score'))
                ->whereIn('target_history.job_id', $userHistoryJobIds)
                ->whereNotIn('peer_history.job_id', $userHistoryJobIds) // Exclude items already touched by user
                ->groupBy('peer_history.job_id')
                ->orderByDesc('co_occurrence_score')
                ->take(4) // Pull the top 4 highly correlated items across the system
                ->pluck('job_id')
                ->toArray();

            if (!empty($recommendedItemScores)) {
                // Wrap each string ID in single quotes for the raw SQL string
                $orderedIdsString = "'" . implode("','", $recommendedItemScores) . "'";

                // Step D: Retrieve details directly without applying any geospatial radius limits
                $collaborativeJobs = JobPosting::whereIn('job_id', $recommendedItemScores)
                    ->orderByRaw("FIELD(job_id, {$orderedIdsString})")
                    ->get();
            }
        }


        // ====================================================
        // FINAL DATA PACKAGING
        // ====================================================
        $expertise = Expertise::all();
        $courses = DB::table('courses')->select('display_name')->distinct()->get();

        // Mapping collections seamlessly right back out to dashboard view parameters
        return view('rec', [
            'jobs'              => $profileMatchedJobs, // Maps to Red Section variable loop hook
            'collaborativeJobs' => $collaborativeJobs,   // Maps to Green Section variable loop hook
            'courses'           => $courses,
            'expertise'         => $expertise
        ]);
    }
    public function details($job_id)
    {
        // 1. Fetch user details to get their latitude and longitude coordinates
        $applicant = \App\Models\UserDetails::where('idno', Auth::user()->idno)->first();
        $jobPreference = \App\Models\WorkDetails::where('idno', Auth::user()->idno)->first();

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
