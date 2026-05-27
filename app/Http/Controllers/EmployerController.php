<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Http\Requests\StoreEmployerRequest;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Employer::where('idno', auth()->user()->idno)->first();
        return view('user.emp', compact('user'));
    }
    // public function store(StoreEmployerRequest $request)
    // {}

}
