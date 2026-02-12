<?php

namespace App\Http\Controllers;

use App\Models\User;
class ExpertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('user.sex');
        $user = User::where('idno', auth()->user()->idno)->first();
        return view('expertise.index', compact('user'));
    }
}
