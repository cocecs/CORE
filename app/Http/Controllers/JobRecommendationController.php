<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
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
}
