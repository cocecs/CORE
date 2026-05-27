<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDetails;

class SearchCourseController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Replace 'your_table' and 'name' with your actual table and column names
        $results = UserDetails::where('educational_level', 'LIKE', '%' . $query . '%')
            ->select('educational_level')
            ->limit(10) // Limit results for better performance
            ->get(['id', 'educational_level']);

        return response()->json($results);
    }
}
