<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    // Return view for the form (or just inject data into your existing job posting view)
    public function getProvinces()
    {
        // Fetch unique provinces sorted alphabetically
        $provinces = DB::table('towns')
            ->distinct()
            ->orderBy('province', 'asc')
            ->pluck('province');

        return response()->json($provinces);
    }

    // Fetch towns based on selected province
    public function getTowns(Request $request)
    {
        $province = $request->query('province');

        $towns = DB::table('towns')
            ->where('province', $province)
            ->orderBy('town', 'asc')
            ->get(['id', 'town']);

        return response()->json($towns);
    }

    // Fetch barangays based on selected town
    public function getBarangays(Request $request)
    {
        $townId = $request->query('town_id');

        $barangays = DB::table('barangays')
            ->where('town_id', $townId)
            ->orderBy('barangay', 'asc')
            ->get(['id', 'barangay']);

        return response()->json($barangays);
    }
}
