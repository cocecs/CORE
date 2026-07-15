<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Http\Requests\StoreEmployerRequest;
use App\Http\Requests\UpdateEmployerRequest;
use App\Models\User;
use App\Models\Course;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Employer::where('email', auth()->user()->email)->first();
        return view('app.emp', compact('user'));
    }

    public function getCourses($expertiseId)
    {
        // Retrieve courses where expertise_id matches, selecting id and display_name
        $courses = Course::where('expertise_id', $expertiseId)
                        ->select('id', 'display_name')
                        ->get();

        return response()->json($courses);
    }

}
