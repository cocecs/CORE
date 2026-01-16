<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WorkDetails;
use App\Models\Professional;

class ProfessionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('idno', auth()->user()->idno)->first();
        return view('professional.exp', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('professional.exp');
    }


    /**
     * Display the specified resource.
     */
    public function show(UserDetails $userDetails)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserDetails $userDetails)
    {
        //
    }
}
