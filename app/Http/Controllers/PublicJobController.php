<?php
namespace App\Http\Controllers;

use App\Models\JobPosting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PublicJobController extends Controller
{
    public function index(Request $request)
    {
        $query = JobPosting::query();

        // Apply filters if passed via request
        if ($request->filled('job_type')) {
            $query->where('job_type', $request->job_type);
        }

        if ($request->filled('course')) {
            $query->where('area_of_expertise', $request->course);
        }

        if ($request->filled('province')) {
            $query->where('province', $request->province);
        }

        if ($request->filled('town')) {
            $query->where('town', $request->town);
        }

        $jobs = $query->latest()->paginate(12);

        // Retrieve course list for drop-down filter options
        $courses = DB::table('job_postings')
            ->select('course as display_name')
            ->whereNotNull('course')
            ->distinct()
            ->get();

        return view('public', compact('jobs', 'courses'));
    }
    public function show($id)
    {
        // Fetch job details and join related tables for public/guest display
        $job = JobPosting::select(
                'job_postings.*',
                'expertises.area_of_expertise',
                'barangays.barangay',
                'towns.town',
            )
            ->leftJoin('expertises', 'job_postings.job_category', '=', 'expertises.id')
            ->leftJoin('barangays', 'job_postings.barangay', '=', 'barangays.id') // adjust foreign keys if needed
            ->leftJoin('towns', 'job_postings.town', '=', 'towns.id')
            ->where('job_postings.job_id', $id)
            ->orWhere('job_postings.id', $id)
            ->firstOrFail();

        return view('publicShow', compact('job'));
    }
}
