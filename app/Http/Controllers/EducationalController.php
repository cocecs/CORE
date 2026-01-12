<?php

namespace App\Http\Controllers;

use App\Models\Educational;
use App\Models\User;
use App\Http\Requests\StoreEducationalRequest;
use App\Http\Requests\UpdateEducationalRequest;

class EducationalController extends Controller
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
    public function store(StoreEducationalRequest $request)
    {
        $idno = auth()->user()->idno;
        Educational::create(array_merge($request->validated(), ['idno' => $idno]));
        return redirect()->route('background.index')->with('success', 'User details saved successfully.');
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
