<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Requests\StoreWorkDetailsRequest;
use App\Models\WorkDetails;

class WorkDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('education.background');
        $user = User::where('idno', auth()->user()->idno)->first();
        return view('education.background', compact('user'));
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
        // dd($request->all());
        $idno = auth()->user()->idno;
        WorkDetails::create(array_merge($request->validated(), ['idno' => $idno]));
        return redirect()->route('background.index')->with('success', 'Work details saved successfully.');
    }

}
