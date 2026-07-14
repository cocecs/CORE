<?php

namespace App\Http\Controllers;
use App\Models\CourseAlias;
use App\Models\UserDetails;
use App\Models\Expertise;
use App\Models\Course;
class ExpertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     // return view('user.sex');
    //     $user = User::where('idno', auth()->user()->idno)->first();
    //     // $expertise = Expertise::where('idno', auth()->user()->idno)->first();
    //     return view('expertise.index', compact('user'));
    // }
    public function processMatch()
    {
        // 1. Fetch user details along with their selected course and related expertise
        $user = UserDetails::with('course.expertise')
            ->where('idno', auth()->user()->idno)
            ->first();

        // 2. Validate that the user exists and has selected a course from the dropdown
        if (!$user) {
            return redirect()->back()->with('error', 'Please select your course in your profile first.');
        }

        // 3. Extract the expertise attached to the predefined course record
        $expertise = $user->course?->expertise;

        // 4. Handle edge-case fallback safely if the predefined course doesn't have an expertise mapped yet
        if (!$expertise) {
            return redirect()->back()->with('error', 'Could not find a matching expertise for your selected course.');
        }

        // 5. Redirect to the SHOW route, passing the unique ID instead of code
        return redirect()->route('expertise.show', ['id' => $expertise->id]);
    }

    public function show($id)
    {
        // Find explicitly by the unique primary ID
        $expertise = Expertise::findOrFail($id);

        $user = UserDetails::where('idno', auth()->user()->idno)->first();

        // Decode the skills here in the controller
        $skills = json_decode($expertise->skills, true) ?? [];

        // Pass the specific $skills array to your view
        $user->educational_level = strtoupper($user->educational_level); // normalize text display just in case

        return view('expertise.index', compact('expertise', 'skills', 'user'));
    }
    // public function show($code)
    // {
    //     $user = UserDetails::where('idno', auth()->user()->idno)->first();
    //     // Make sure it returns a single model object, not a collection array
    //     $expertise = Expertise::where('exp_code', $code)->firstOrFail();

    //     return view('expertise.index', compact('expertise', 'user'));
    // }
}
