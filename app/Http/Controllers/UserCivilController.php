<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetails;
use App\Models\UserSex;
use App\Http\Requests\UpdateUserSexRequest;
class UserCivilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('user.sex');
        $user = User::where('idno', auth()->user()->idno)->first();
        return view('user.civil', compact('user'));
    }




    /**
     * Display the specified resource.
     */
    public function show(UserDetails $userDetails)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserSexRequest $request, UserSex $idno)
    {
        UserSex::create($request->validated());
        return redirect()->route('sex.index')->with('success', 'User sex and gender saved successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserDetails $userDetails)
    {
        //
    }
}
