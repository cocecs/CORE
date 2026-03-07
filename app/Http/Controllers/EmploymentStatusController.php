<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\EmploymentStatusRequest;

class EmploymentStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('idno', auth()->user()->idno)->first();
        return view('job.index', compact('user'));
    }



}
