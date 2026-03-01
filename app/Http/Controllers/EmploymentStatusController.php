<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\EmploymentStatus;
use App\Http\Requests\EmploymentStatusRequest;

class EmploymentStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(EmploymentStatusRequest $request)
    {
        // $validatedData = $request->validate([
        //     'employment_status' => 'required|string',
        // ]);
        // $user = User::where('idno', auth()->user()->idno)->first();
        // if ($validatedData['employment_status'] == 'employed') {
        //     return view('employment.index', compact('user'));
        // } else {
        //     return view('expjob.index', compact('user'));
        // }

    }



}
