<?php

namespace App\Http\Controllers;

use App\Http\Requests\FourpsRequest;
use App\Models\User;

class FourpsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('idno', auth()->user()->idno)->first();
        return view('employment.fourps', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

}
