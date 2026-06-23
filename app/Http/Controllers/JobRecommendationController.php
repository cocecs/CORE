<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use Carbon\Carbon;

class JobRecommendationController extends Controller
{
    /**
     * Display the recommended job listings.
     */
    public function index()
    {
        // 1. Fetch the recommended jobs from the database
        // Adjust the query filters/ordering to match your actual requirements
        $jobs = JobPosting::where('is_active', true)
            ->latest()
            ->take(10) // Limit for UI performance
            ->get();

        // 2. Dynamically inject the "is_new" logic if it's not a database column
        // For example, marking jobs posted within the last 48 hours as "New to you"
        $jobs->transform(function ($job) {
            $job->is_new = $job->created_at->greaterThanOrEqualTo(Carbon::now()->subHours(48));
            return $job;
        });

        // 3. Pass the data to your blade view
        return view('rec', compact('jobs'));
    }
}
