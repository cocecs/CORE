<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfwRequest;
use App\Models\User;

class OfwController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('idno', auth()->user()->idno)->first();
        return view('employment.ofw', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

}
