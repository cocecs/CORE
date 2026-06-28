<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

use App\Models\User;
use App\Models\UserDetails;
use App\Models\Employer;
use App\Models\JobPosting;
use App\Models\JobApplication;
use App\Http\Requests\StoreUserDetailsRequest;

class AdminAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('idno', auth()->user()->idno)->first();
        return view('adtv.index', compact('user'));
    }
    public function adtv_addUser()
    {
        $user = User::where('idno', auth()->user()->idno)->first();
        return view('adtv.nu', compact('user'));
    }
    public function adtv_storeEmployer()
    {
        $user = User::where('idno', auth()->user()->idno)->first();
        return view('adtv.emp', compact('user'));
    }

    public function adtv_listUsers(): View
    {
        // Fetch and separate users by their account usertype
        $admins = UserDetails::whereHas('account', function ($query) {
            $query->where('usertype', 'admin');
        })->with('account')->get();

        $employers = Employer::whereHas('account', function ($query) {
            $query->where('usertype', 'employer');
        })->with('account')->get();

        $users = UserDetails::whereHas('account', function ($query) {
            $query->where('usertype', 'user');
        })->with('account')->get();

        // Pass all three distinct collections to the blade view
        return view('adtv.lu', compact('admins', 'employers', 'users'));
    }

    /**
     * Optional: Display the filtered list of administrators.
     */
    public function adtv_listAdmins(): View
    {
        // Filters UserDetails where the related account has 'usertype' = 'admin'
        $admins = UserDetails::whereHas('account', function ($query) {
            $query->where('usertype', 'admin');
        })->with('account')->get();

        return view('adtv.la', compact('admins'));
    }
    public function adtv_storeUser(Request $request)
    {
        // 1. Validate both the user credentials and the profile details together
        $validatedData = $request->validate([
            'firstname'     => ['required', 'string', 'max:255'],
            'middlename'    => ['nullable', 'string', 'max:255'],
            'lastname'      => ['required', 'string', 'max:255'],
            'ext'           => ['nullable', 'string', 'max:50'],
            'date_of_birth' => ['required', 'date'],
            'email'         => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password'      => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 2. Use a transaction to safely save to both tables
        DB::transaction(function () use ($request, $validatedData) {

            // Create the brand new user first
            $newUser = User::create([
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'usertype' => 'admin',
            ]);

            // Create the user details and link them via the newly generated 'idno'
            UserDetails::create([
                'idno'          => $newUser->idno, // Pulls the automatically generated idno from the model's booted method
                'firstname'     => $request->firstname,
                'middlename'    => $request->middlename,
                'lastname'      => $request->lastname,
                'ext'           => $request->ext,
                'date_of_birth' => $request->date_of_birth,
            ]);
        });

        // 3. Redirect back to your list view
        return redirect()
            ->route('adtv_listUsers')
            ->with('success', 'User and personal details saved successfully.');
    }
    public function store(Request $request): RedirectResponse
    {
        // 1. Validate the combined form data
        $request->validate([
            'firstname'     => ['required', 'string', 'max:255'],
            'middlename'    => ['nullable', 'string', 'max:255'],
            'lastname'      => ['required', 'string', 'max:255'],
            'ext'           => ['nullable', 'string', 'max:50'],
            'date_of_birth' => ['required', 'date'],
            'email'         => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password'      => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 2. Use a database transaction to execute queries atomically
        DB::transaction(function () use ($request) {

            // Write to 'users' table
            $user = User::create([
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'usertype' => 'user', // Defaults the new account to standard user
            ]);

            // Write to 'user_details' table using the relationship link
            $user->details()->create([
                'firstname'     => $request->firstname,
                'middlename'    => $request->middlename,
                'lastname'      => $request->lastname,
                'ext'           => $request->ext,
                'date_of_birth' => $request->date_of_birth,
            ]);
        });

        // 3. Return back or to an index table with success status
        return redirect()
            ->route('adtv_listUsers') // Change this route to wherever you want the admin to go next
            ->with('status', 'User and personal details created successfully!');
    }
    public function listJobs()
    {
        // Fetch all job postings sorted by newest
        $jobs = JobPosting::orderBy('created_at', 'desc')->get();

        // Get total count for the upper badge indicator
        $totalJobs = $jobs->count();

        return view('adtv.loj', compact('jobs', 'totalJobs'));
    }
    public function jobDetails($job_id)
    {
        $jobApp = JobApplication::where('job_id', $job_id)->count();
        $job = JobPosting::where('job_id', $job_id)->firstOrFail();

        return view('adtv.lojd', compact('job', 'jobApp'));
    }
    public function jobApplicants($job_id)
    {
        $job = JobPosting::where('job_id', $job_id)->firstOrFail();
        $applicants = $job->applicants;
        return view('adtv.loa', compact('job', 'applicants'));
    }

    public function applProfile($idno, $job_id)
    {
        // Queries the exact application instance using both identifier strings
        $application = JobApplication::with(['user.details'])
            ->where('user_id', $idno)
            ->where('job_id', $job_id)
            ->firstOrFail();

        $user = $application->user;
        $userDetails = $user->details;

        return view('adtv.appl', compact('application', 'user', 'userDetails'));
    }
}
