<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkDetailsRequest;
use App\Models\User;

class JobHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('idno', auth()->user()->idno)->first();
        return view('job.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkDetailsRequest $request)
    {
        //
    }

}
