<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

use App\Models\User;
use App\Models\UserDetails;
use App\Http\Requests\StoreUserDetailsRequest;
use App\Http\Requests\UpdateUserDetailsRequest;
use App\Http\Requests\UpdateUserSexRequest;
use App\Http\Requests\UpdateUserGenderRequest;
use App\Http\Requests\UpdateUserAboutRequest;
use App\Http\Requests\UpdateUserCivilRequest;
use App\Http\Requests\UpdateUserCourseRequest;

class UserDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('email', auth()->user()->email)->first();
        return view('app.details', compact('user'));
    }
    public function profile()
    {
        $user = UserDetails::where('idno', auth()->user()->idno)->first();
        return view('app.profile', compact('user'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.details');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserDetailsRequest $request)
    {
        $user = User::where('email', auth()->user()->email)->first();
        UserDetails::create(array_merge($request->validated(), [
            'idno' => $user->idno,
        ]));

        return redirect()->route('address.index')->with('success', 'User details saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserDetails $userDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserDetails $userDetails)
    {
        //
    }
    /**
     * Update the specified resource in storage. Without coordinates fetching and barangay update
     */
    public function update(UpdateUserDetailsRequest $request, $idno)
    {
        // 1. Get the validated form data
        $validatedData = $request->validated();

        // 2. Find the user record or fail with a 404 if not found
        $userAddress = UserDetails::where('idno', $idno)->firstOrFail();

        // 3. Directly update user details with the form data
        $userAddress->update($validatedData);

        // 4. Redirect to the index page with a success message
        return redirect()->route('sex.index')->with('success', 'User address details saved.');
    }
    /**
     * Update the specified resource in storage. With coordinates fetching and barangay update
     */
    // public function update(UpdateUserDetailsRequest $request, $idno)
    // {
    //     $validatedData = $request->validated();

    //     // 1. Retrieve the selected Barangay and its parent Town
    //     $barangay = DB::table('barangays')->where('id', $request->input('brgy'))->first();

    //     $latitude  = null;
    //     $longitude = null;

    //     if ($barangay) {
    //         $town = DB::table('towns')->where('id', $barangay->town_id)->first();

    //         // 2. Construct the precise address search string
    //         $searchAddress = "{$barangay->barangay}, {$town->town}, {$town->province}, Philippines";

    //         // 3. Query the Geocoding API
    //         try {
    //             $response = Http::withHeaders([
    //                 'User-Agent' => 'ARC_Application/1.0 (contact@yourdomain.com)'
    //             ])->timeout(7)->get('https://nominatim.openstreetmap.org/search', [
    //                 'q'      => $searchAddress,
    //                 'format' => 'json',
    //                 'limit'  => 1
    //             ]);

    //             if ($response->successful() && !empty($response->json())) {
    //                 $geoData   = $response->json()[0];
    //                 $latitude  = $geoData['lat'];
    //                 $longitude = $geoData['lon'];
    //             }
    //         } catch (\Exception $e) {
    //             report($e); // Logs the error silently if the connection drops
    //         }
    //     }

    //     // 4. Update user details with the form data and the precise coordinates (or null if not found)
    //     $userAddress = UserDetails::where('idno', $idno)->firstOrFail();
    //     $userAddress->update(array_merge($validatedData, [
    //         'latitude'  => $latitude,
    //         'longitude' => $longitude
    //     ]));

    //     return redirect()->route('sex.index')->with('success', 'User address details saved.');
    // }





    /**
     * Update the specified resource in storage. With coordinates fetching and barangay update, with coordinates in barangays table
     */
    // public function update(UpdateUserDetailsRequest $request, $idno)
    // {
    //     $validatedData = $request->validated();

    //     // 1. Retrieve the selected Barangay and its parent Town
    //     $barangay = DB::table('barangays')->where('id', $request->input('brgy'))->first();

    //     $latitude  = null;
    //     $longitude = null;

    //     if ($barangay) {
    //         $town = DB::table('towns')->where('id', $barangay->town_id)->first();

    //         // 2. Construct the precise address search string
    //         $searchAddress = "{$barangay->barangay}, {$town->town}, {$town->province}, Philippines";

    //         // 3. Query the Geocoding API
    //         try {
    //             $response = Http::withHeaders([
    //                 'User-Agent' => 'ARC_Application/1.0 (contact@yourdomain.com)'
    //             ])->timeout(7)->get('https://nominatim.openstreetmap.org/search', [
    //                 'q'      => $searchAddress,
    //                 'format' => 'json',
    //                 'limit'  => 1
    //             ]);

    //             if ($response->successful() && !empty($response->json())) {
    //                 $geoData   = $response->json()[0];
    //                 $latitude  = $geoData['lat'];
    //                 $longitude = $geoData['lon'];
    //             }
    //         } catch (\Exception $e) {
    //             report($e); // Logs the error silently if the connection drops
    //         }
    //     }

    //     // 4. Update both UserDetails and Barangays tables securely inside a transaction
    //     DB::transaction(function () use ($idno, $validatedData, $latitude, $longitude, $barangay) {
    //         // Update user details with the form data and the precise coordinates
    //         $userAddress = UserDetails::where('idno', $idno)->firstOrFail();
    //         $userAddress->update(array_merge($validatedData, [
    //             'latitude'  => $latitude,
    //             'longitude' => $longitude
    //         ]));

    //         // NEW: Update the coordinates in the barangays table if coordinates were found
    //         if ($barangay && $latitude && $longitude) {
    //             DB::table('barangays')
    //                 ->where('id', $barangay->id)
    //                 ->update([
    //                     'latitude'   => $latitude, // Ensure these column names match your DB schema
    //                     'longitude'  => $longitude,
    //                     'updated_at' => now()       // Good practice if you track timestamps manually here
    //                 ]);
    //         }
    //     });

    //     return redirect()->route('sex.index')->with('success', 'User address and barangay details saved.');
    // }
    public function updatesex(UpdateUserSexRequest $request, $idno)
    {
        // $validatedData = $request->validate([
        //     'sex' => 'required|string|max:1',
        // ]);

        $validatedData = $request->validated();
        $userAddress = UserDetails::where('idno', $idno)->firstOrFail();
        $userAddress->update($validatedData);
        return redirect()->route('gender.index')->with('success', 'User details saved successfully.');

    }
    public function updateGender(UpdateUserGenderRequest $request, $idno)
    {
        if ($request->filled('custom_gender')) {
            $request->merge(['gender' => $request->custom_gender]);
        }

        // $validatedData = $request->validate([
        //     'gender' => 'required|string|max:15',
        // ]);

        $validatedData = $request->validated();
        $userAddress = UserDetails::where('idno', $idno)->firstOrFail();
        $userAddress->update($validatedData);
        return redirect()->route('civil.index')->with('success', 'User details saved successfully.');

    }

    public function updateCivil(UpdateUserCivilRequest $request, $idno)
    {
        // $validatedData = $request->validate([
        //     'civil_status' => 'required|string|max:15',
        // ]);

        $validatedData = $request->validated();
        $userDetail = UserDetails::where('idno', $idno)->firstOrFail();
        $userDetail->update($validatedData);
        return redirect()->route('background.index')->with('success', 'User details saved successfully.');

    }
    public function updateAbout(UpdateUserAboutRequest $request, $idno)
    {
        // $validatedData = $request->validate([
        //     'about_me' => 'required|string|max:255',
        // ]);

        $validatedData = $request->validated();
        $userAddress = UserDetails::where('idno', $idno)->firstOrFail();
        $userAddress->update($validatedData);
        return redirect()->route('background.index')->with('success', 'User details saved successfully.');

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserDetails $userDetails)
    {
        //
    }
}
