<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class DistanceJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('idno', auth()->user()->idno)->first();
        return view('job.distance', compact('user'));
    }

}
