<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetails;
use App\Models\UserSex;
use App\Http\Requests\UpdateUserSexRequest;
class UserAboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('user.sex');
        $user = User::where('idno', auth()->user()->idno)->first();
        return view('user.about', compact('user'));
    }


}
