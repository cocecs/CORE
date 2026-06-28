<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobApplicationController extends Controller
{
    public function apply(Request $request, $job_id)
    {
        $user = Auth::user();
        $job = JobPosting::findOrFail($job_id);

        // Check if the user has already applied to this job
        if ($user->appliedJobs()->where('job_id', $job_id)->exists()) {
            return redirect()->back()->with('error', 'You have already applied for this job.');
        }

        // Attach the job to the user with default 'pending' status
        $user->appliedJobs()->attach($job_id, ['status' => 'pending']);

        return redirect()->back()->with('success', 'Application submitted successfully!');
    }

    public function cancel(Request $request, $job_id)
    {
        $user = Auth::user();

        // Detach the job to cancel the application
        $user->appliedJobs()->detach($job_id);

        return redirect()->back()->with('success', 'Application withdrawn successfully.');
    }
}
