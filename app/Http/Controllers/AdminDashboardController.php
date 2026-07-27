<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Carbon\Carbon;

use App\Models\User;
use App\Models\UserDetails;
use App\Models\Employer;
use App\Models\JobPosting;
use App\Models\JobApplication;
use App\Http\Requests\StoreUserDetailsRequest;

class AdminDashboardController extends Controller
{
    public function index()
    {


        $ages = DB::table('user_details')
            ->join('users', 'user_details.idno', '=', 'users.idno')
            ->where('users.usertype', '=', 'user')
            ->selectRaw('TIMESTAMPDIFF(YEAR, user_details.date_of_birth, NOW()) as age')
            ->pluck('age');

        $ageBrackets = [
            // '0-17'  => 0,
            '18-30' => 0,
            '31-50' => 0,
            '51+'   => 0,
        ];

        foreach ($ages as $age) {
            // if ($age <= 17) {
            //     $ageBrackets['0-17']++;
            // } else
            if ($age >= 18 && $age <= 30) {
                $ageBrackets['18-30']++;
            } elseif ($age >= 31 && $age <= 50) {
                $ageBrackets['31-50']++;
            } elseif ($age >= 51) {
                $ageBrackets['51+']++;
            }
        }

        // 2. Query and group your counts for the charts
        $stats = [
            'gender' => DB::table('user_details')
                ->join('users', 'user_details.idno', '=', 'users.idno')
                ->where('users.usertype', '=', 'user')
                ->wherenotnull('user_details.gender')
                ->wherenotnull('user_details.sex')
                ->groupBy('user_details.gender')
                ->select('user_details.gender', DB::raw('count(*) as total'))
                ->pluck('total', 'user_details.gender')
                ->toArray(),

            'age_brackets' => $ageBrackets,

            // 'locations' => DB::table('user_details')
            //     ->join('users', 'user_details.idno', '=', 'users.idno')
            //     ->where('users.usertype', '=', 'user')
            //     ->groupBy('user_details.brgy')
            //     ->select('user_details.brgy', DB::raw('count(*) as total'))
            //     ->pluck('total', 'user_details.brgy')
            //     ->toArray(),

            'locations' => DB::table('user_details')
                    ->join('users', 'user_details.idno', '=', 'users.idno')
                    // Join the barangays table using the brgy ID
                    ->join('barangays', 'user_details.brgy', '=', 'barangays.id')
                    ->where('users.usertype', '=', 'user')
                    // Group by the barangay name so identical names aggregate together
                    ->groupBy('barangays.barangay')
                    // Select the name and the count
                    ->select('barangays.barangay as brgy_name', DB::raw('count(*) as total'))
                    // Pluck the total, keyed by the barangay name
                    ->pluck('total', 'brgy_name')
                    ->toArray(),

            // 'education' => DB::table('user_details')
            //     ->join('users', 'user_details.idno', '=', 'users.idno')
            //     ->where('users.usertype', '=', 'user')
            //     ->groupBy('user_details.educational_level')
            //     ->select('user_details.educational_level', DB::raw('count(*) as total'))
            //     ->pluck('total', 'user_details.educational_level')
            //     ->toArray(),

            'education' => DB::table('user_details')
                ->join('users', 'user_details.idno', '=', 'users.idno')
                ->where('users.usertype', '=', 'user')
                ->whereNotNull('user_details.educational_level') // Prevents empty strings/nulls from breaking the chart labels
                ->groupBy('user_details.educational_level')
                ->select('user_details.educational_level', DB::raw('count(*) as total'))
                ->pluck('total', 'user_details.educational_level')
                ->toArray(),

            'total_employers' => DB::table('employers')->count(),
            'total_jobpostings' => DB::table('job_postings')->count(),
            'total_jobsaves'       => DB::table('job_saves')->count(),
            'total_jobapplications'=> DB::table('job_applications')->count(),

                // Counts everyone who reached the interview stage
                'interviewees' => DB::table('job_interviewees')
                    ->where('status', '=', 'interviewee')
                    ->count(),

                // Counts only those who successfully got hired
                'hired' => DB::table('job_interviewees')
                    ->where('status', '=', 'hired')
                    ->count(),

        ];

        return view('adtv.rp', compact('stats'));

    }
    public function rp2()
    {
        $vacanciesSolicited = DB::table('job_postings')->count();
        $applicantsRegistered = DB::table('users')
            ->where('usertype', 'user')
            ->count();
        $applicantsReferred = DB::table('job_applications')->count();
        $applicantsPlaced = DB::table('job_interviewees')
            ->where('status', 'hired')
            ->count();

        // Calculate placement rate
        $placementRate = ($applicantsReferred > 0) ? ($applicantsPlaced / $applicantsReferred) * 100 : 0;

        return view('adtv.rp2', compact(
            'vacanciesSolicited',
            'applicantsRegistered',
            'applicantsReferred',
            'applicantsPlaced',
            'placementRate'
        ));
    }
    public function rp3()
    {
        // 1. Fetch data by joining tables as specified
        // Adjust foreign keys ('user_id') to match your actual database schema
        $rawApplicants = DB::table('user_details')
            ->join('work_details', 'user_details.idno', '=', 'work_details.idno')
            ->leftJoin('job_applications', 'user_details.idno', '=', 'job_applications.user_id')
            ->select([
                'user_details.firstname',
                'user_details.middlename',
                'user_details.lastname',
                'user_details.ext',
                'work_details.skills', // Assuming JSON or cast string array
                'user_details.sex',
                'user_details.date_of_birth as birthdate',
                'user_details.civil_status', // Added to populate table column
                // 'user_details.work_experience as work_experience_years',
                'user_details.educational_level as educational_attainment',
                'job_applications.status as employment_status'
            ])
            ->get();

        // 2. Transform the collection to compute exact age string formats (e.g., "47y 7mos")
        $applicants = $rawApplicants->map(function ($applicant) {
            // Handle array transformation for skills if stored as JSON/Serialized text
            if (is_string($applicant->skills)) {
                $skillsArray = json_decode($applicant->skills, true);
                $applicant->skills = is_array($skillsArray) ? implode(', ', $skillsArray) : $applicant->skills;
            } elseif (is_array($applicant->skills)) {
                $applicant->skills = implode(', ', $applicant->skills);
            }

            // Calculate precise age text layout matching image_50a343.png
            if ($applicant->birthdate) {
                $birthDate = Carbon::parse($applicant->birthdate);

                // Carbon's ->age property automatically calculates the whole number of years
                $applicant->age_formatted = $birthDate->age;
            } else {
                $applicant->age_formatted = 'N/A';
            }

            // Fallback for null employment status rows
            $applicant->employment_status = $applicant->employment_status ?? 'Unemployed (None)';

            return $applicant;
        });

        // 3. Pass values to report configurations
        $pesoName = "VICTORIA S. BERIOSO";
        $reportMonth = Carbon::now()->format('F Y');

        return view('adtv.rp3', compact('applicants', 'pesoName', 'reportMonth'));
    }
    public function rp4()
    {
        $placedApplicants = DB::table('user_details')
            ->join('job_interviewees', 'user_details.idno', '=', 'job_interviewees.user_id')
            // Joining job_postings to get the job title
            // NOTE: Change 'job_id' if your foreign key column has a different name (e.g., 'job_posting_id')
            ->join('job_postings', 'job_interviewees.job_id', '=', 'job_postings.job_id')
            ->select([
                // Concatenating fields into a single uppercase format: "LASTNAME, FIRSTNAME MIDDLENAME EXT"
                DB::raw("UPPER(CONCAT(user_details.lastname, ', ', user_details.firstname, ' ', COALESCE(user_details.middlename, ''), ' ', COALESCE(user_details.ext, ''))) as name"),
                'user_details.sex',
                // Retrieving the actual job title from the job_postings table
                'job_postings.job_title as placed_as'
            ])
            ->whereIn('job_interviewees.status', ['placed', 'hired'])
            ->get();

        $pesoName = "VICTORIA S. BERIOSO";
        $reportMonth = "January 2026";

        return view('adtv.rp4', compact('placedApplicants', 'pesoName', 'reportMonth'));
    }
}
