<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Http\Requests\StoreEmployerRequest;
use App\Http\Requests\UpdateEmployerRequest;
use App\Models\User;
use App\Models\Expertise;

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
        $empuser = User::where('email', auth()->user()->email)->first();
        Employer::create(array_merge($request->validated(), [
            'idno' => $empuser->idno,
            'email' => $empuser->email,
        ]));

        return redirect()->route('emp.about')->with('success', 'User details saved successfully.');
    }
    public function emp_about()
    {
        $user = User::where('idno', auth()->user()->idno)->first();
        return view('user.empa', compact('user'));
    }
    public function update_about(UpdateEmployerRequest $request, $idno)
    {
        $validatedData = $request->validate([
            'about' => 'string',
        ]);

        $about = Employer::where('idno', $idno)->firstOrFail();
        $about->update($validatedData);
        return redirect()->route('emp.post')->with('success', 'User details saved successfully.');

    }
    public function emp_post()
    {
        $expertise = Expertise::all();

        // FIX: Redirect to the SHOW route, passing the 'code'
        return view('user.post', compact('expertise'));
    }
}
