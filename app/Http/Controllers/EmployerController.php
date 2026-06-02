<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Http\Requests\StoreEmployerRequest;
use App\Models\User;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Employer::where('email', auth()->user()->email)->first();
        return view('user.emp', compact('user'));
    }
    public function emp_store(StoreEmployerRequest $request)
    {
        $user = User::where('email', auth()->user()->email)->first();
        Employer::create(array_merge($request->validated(), [
            'idno' => $user->idno,
            'email' => $user->email,
            'company_name' => $user->company_name,
        ]));

        return redirect()->route('emp.store')->with('success', 'User details saved successfully.');
    }

}
