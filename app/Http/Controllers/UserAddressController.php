<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetails;
use App\Models\UserAddress;
use App\Http\Requests\UpdateUserAddressRequest;

class UserAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('email', auth()->user()->email)->first();
        return view('user.address', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.address');
    }


    /**
     * Display the specified resource.
     */
    public function show(UserAddress $userAddress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserAddress $userAddress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserAddressRequest $request, UserAddress $idno)
    {
        UserAddress::create($request->validated());
        return redirect()->route('address.index')->with('success', 'User address saved successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserAddress $userAddress)
    {
        //
    }
}
