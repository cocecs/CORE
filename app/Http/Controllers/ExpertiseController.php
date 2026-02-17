<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetails;
use App\Models\Expertise;
class ExpertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     // return view('user.sex');
    //     $user = User::where('idno', auth()->user()->idno)->first();
    //     // $expertise = Expertise::where('idno', auth()->user()->idno)->first();
    //     return view('expertise.index', compact('user'));
    // }
    public function processMatch()
    {
        $user = UserDetails::where('idno', auth()->user()->idno)->first();

        // Check if user has an education level
        if (!$user || !$user->educational_level) {
            return redirect()->back()->with('error', 'Educational level not found in your profile.');
        }

        $educationString = $user->educational_level;
        $matchedAreaName = $this->performKeywordMatch($educationString);

        $expertise = Expertise::where('area_of_expertise', $matchedAreaName)->first();

        if (!$expertise) {
            return redirect()->back()->with('error', 'Could not find a matching expertise in the database.');
        }

        // FIX: Redirect to the SHOW route, passing the 'code'
        return redirect()->route('expertise.show', ['code' => $expertise->exp_code]);
    }

    public function show($code) // Changed parameter from $idno to $code to match route
    {
        $user = UserDetails::where('idno', auth()->user()->idno)->first();

        // Find the record using the unique 5-character code from your DB
        $expertises = Expertise::where('exp_code', $code)->get();

        // Return the view (ensure this file exists at resources/views/expertise/index.blade.php)
        return view('expertise.index', compact('expertises', 'user'));
    }
    private function performKeywordMatch($educationString)
    {
        // 1. Convert to lowercase so "TECHNOLOGY" and "technology" both match
        $educationString = strtolower($educationString);

        // 2. Define the "Trigger Words" for each Area of Expertise
        // These names MUST match the 'area_of_expertise' column in your phpMyAdmin image
        $map = [
            'Technology & IT'            => ['BSIT', 'Bachelor of Science in Information Technology',
                                             'BSCS', 'Bachelor of Science in Computer Science',
                                             'BSIS', 'Bachelor of Science in Information Systems',
                                             'BSC', 'Bachelor of Science in Computer Engineering',
                                             'BS Cybersecurity', 'Bachelor of Science in Cybersecurity',
                                             'BSDS', 'Bachelor of Science in Data Science',
                                             'BSEMC', 'Bachelor of Science in Entertainment and Multimedia Computing',
                                             'information technology', 'computer', 'software', 'tech', 'programming',
                                             'web', 'network', 'database', 'cybersecurity', 'data science', 'multimedia computing',
                                             'Cloud Computing', 'Artificial Intelligence', 'Machine Learning', 'Data Analytics', 'Software Development', 'Cybersecurity'],
            'Creative & Design'          => ['BSAM', 'BSAMA', 'Bachelor of Science in Animation Multimedia and Arts',
                                             'BFA', 'Bachelor of Fine Arts',
                                             'BSMA', 'Bachelor of Science in Multimedia Arts',
                                             'BAMA', 'Bachelor of Arts in Multimedia Arts',
                                             'BSID', 'Bachelor of Science in Interior Design',
                                             'BACD', 'Bachelor of Arts in Creative Design',
                                             'BAC', 'Bachelor of Arts in Communication',
                                             'BSFDT', 'Bachelor of Science in Fashion Design and Technology',
                                             'media studies', 'arts', 'design', 'graphic', 'video', 'multimedia', 'animation', 'creative'],
            'Business & Administration'  => ['business', 'management', 'admin', 'office', 'entrepreneur'],
            'Marketing & Sales'          => ['marketing', 'sales', 'advertising', 'pr', 'market'],
            'Healthcare & Life Sciences' => ['nurse', 'nursing', 'doctor', 'medicine', 'health', 'medical', 'biology'],
            'Education & Training'       => ['teacher', 'teaching', 'education', 'training', 'pedagogy', 'school'],
            'Finance & Legal'            => ['accountancy', 'cpa', 'law', 'legal', 'finance', 'banking', 'audit'],
            'Logistics & Supply Chain'   => ['logistic', 'shipping', 'warehouse', 'supply', 'chain', 'transport'],
            'Human Resources'            => ['hr', 'recruitment', 'personnel', 'relations'],
            'Research'                   => ['BSCS', 'science', 'data', 'research', 'analysis', 'laboratory'],
            // --- NEW 'OTHER' CATEGORIES ---
            'Skilled Trades & Construction' => ['carpenter', 'electrician', 'plumber', 'construction', 'welding', 'mechanic', 'engineering', 'masonry'],
            'Hospitality & Tourism'         => ['hotel', 'tourism', 'culinary', 'chef', 'cooking', 'travel', 'restaurant', 'waiter', 'concierge'],
            'Customer Service'              => ['support', 'customer', 'call center', 'helpdesk', 'client service', 'receptionist'],
            'Social & Community Services'   => ['social work', 'non-profit', 'ngo', 'volunteer', 'community', 'counseling', 'psychology'],
            'Agriculture & Environment'     => ['farming', 'agriculture', 'forestry', 'environmental', 'horticulture', 'wildlife', 'sustainability'],
            'Media & Communication'         => ['journalism', 'writer', 'editor', 'content', 'broadcasting', 'media', 'copywriting']
        ];
        // 3. Loop through the map to see if any keyword exists in the user's input
        foreach ($map as $expertiseName => $keywords) {
            foreach ($keywords as $word) {
                if (str_contains($educationString, $word)) {
                    // If we find a match, return the Expertise Name immediately
                    return $expertiseName;
                }
            }
        }
        // 4. Fallback: If no keywords match, return a default category
        return 'Others';
    }
}
