<?php

namespace App\Http\Controllers;

use App\Models\Educational;
use App\Models\User;
use App\Http\Requests\StoreEducationalRequest;
use App\Http\Requests\UpdateEducationalRequest;
use App\Http\Requests\UpdateUserCourseRequest;
use App\Models\UserDetails;
use App\Models\Course;


class EducationalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('education.background');
        $user = User::where('idno', auth()->user()->idno)->first();

        // Fetch only associate courses
        $associateCourses = Course::where('educ_level', 'associate')
            ->orderBy('display_name', 'asc')
            ->get();

        // Fetch only bachelor courses
        $bachelorCourses = Course::where('educ_level', 'bachelor')
            ->orderBy('display_name', 'asc')
            ->get();

        // Fetch only vocational courses
        $vocationalCourses = Course::where('educ_level', 'vocational')
            ->orderBy('display_name', 'asc')
            ->get();

        // Fetch only doctoral courses
        $doctoralCourses = Course::where('educ_level', 'doctorate')
            ->orderBy('display_name', 'asc')
            ->get();

        $mastersCourses = Course::where('educ_level', 'masters')
            ->orderBy('display_name', 'asc')
            ->get();

        return view('education.background', compact('user', 'associateCourses', 'bachelorCourses', 'vocationalCourses', 'doctoralCourses', 'mastersCourses'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function vocational()
    {
        $user = User::where('idno', auth()->user()->idno)->first();
        return view('education.vocational', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEducationalRequest $request)
    {
        $idno = auth()->user()->idno;
        Educational::create(array_merge($request->validated(), ['idno' => $idno]));
        return redirect()->route('background.index')->with('success', 'User details saved successfully.');
    }
    // public function updateCourse(UpdateUserCourseRequest $request, $idno)
    // {
    //     // 1. Extract the string from the custom_course array
    //     $customCourse = null;
    //     if ($request->has('custom_course')) {
    //         // Filter the array to find the index that isn't empty (e.g., "BACHELOR")
    //         $customCourse = collect($request->custom_course)->filter()->first();
    //     }

    //     // 2. Determine what to save
    //     // If a custom course was typed, use that. Otherwise, use the radio value.
    //     $levelToSave = $customCourse ? strtoupper($customCourse) : $request->educational_level;

    //     // 3. Find and Update
    //     $userCourse = UserDetails::where('idno', $idno)->firstOrFail();

    //     $userCourse->update([
    //         'educational_level' => $levelToSave
    //     ]);

    //     // $idno = auth()->user()->idno;
    //     // Educational::create(array_merge($request->validated(), ['idno' => $idno, 'course_degree' => $levelToSave]));

    //     return redirect()->route('expertise.process')->with('success', 'User details saved successfully.');
    // }
    public function updateCourse(UpdateUserCourseRequest $request, $idno)
    {
        $educationalLevel = $request->input('educational_level');
        $levelToSave = '';
        $courseIdToSave = null; // Initialize as null for cases like Elementary/High School

        switch ($educationalLevel) {
            case 'N':
                $levelToSave = 'NO FORMAL EDUCATION';
                break;
            case '1':
                $levelToSave = 'ELEMENTARY';
                break;
            case '2':
                $levelToSave = 'HIGH SCHOOL';
                break;
            case '3': // Vocational
                $courseIdToSave = $request->input('course_vocational');
                if ($courseIdToSave) {
                    $course = Course::find($courseIdToSave);
                    $levelToSave = $course ? strtoupper($course->display_name) : 'VOCATIONAL';
                } else {
                    $levelToSave = 'VOCATIONAL';
                }
                break;
            case '4': // Associate Degree
                $courseIdToSave = $request->input('course_associate');
                if ($courseIdToSave) {
                    $course = Course::find($courseIdToSave);
                    $levelToSave = $course ? strtoupper($course->display_name) : 'ASSOCIATE DEGREE';
                } else {
                    $levelToSave = 'ASSOCIATE DEGREE';
                }
                break;
            case '5': // Bachelor's Degree
                $courseIdToSave = $request->input('course_bachelor');
                if ($courseIdToSave) {
                    $course = Course::find($courseIdToSave);
                    $levelToSave = $course ? strtoupper($course->display_name) : "BACHELOR'S DEGREE";
                } else {
                    $levelToSave = "BACHELOR'S DEGREE";
                }
                break;
            case '6': // Masters
                $courseIdToSave = $request->input('course_masters');
                if ($courseIdToSave) {
                    $course = Course::find($courseIdToSave);
                    $levelToSave = $course ? strtoupper($course->display_name) : "MASTERS";
                } else {
                    $levelToSave = "MASTERS";
                }
                break;
            case '7': // Doctorate
                $courseIdToSave = $request->input('course_doctoral');
                if ($courseIdToSave) {
                    $course = Course::find($courseIdToSave);
                    $levelToSave = $course ? strtoupper($course->display_name) : "DOCTORATE";
                } else {
                    $levelToSave = "DOCTORATE";
                }
                break;
            default:
                $levelToSave = 'UNKNOWN';
                break;
        }

        // Find and Update both the string label and the relational foreign key ID
        $userCourse = UserDetails::where('idno', $idno)->firstOrFail();
        $userCourse->update([
            'educational_level' => $levelToSave,
            'course_id'         => $courseIdToSave // <-- Save the relation ID here!
        ]);

        return redirect()->route('expertise.process')->with('success', 'User details saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(educational $educational)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(educational $educational)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateeducationalRequest $request, educational $educational)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(educational $educational)
    {
        //
    }
}
