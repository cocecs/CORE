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
            'Business & Administration'  => ['BBA', 'Bachelor of Business Administration',
                                             'BSBA', 'Bachelor of Science in Business Administration',
                                             'BSB', 'Bachelor of Science in Business',
                                             'BMS', 'Bachelor of Management Studies',
                                             'BSA', 'Bachelor of Science in Accountancy',
                                             'BSE', 'Bachelor of Science in Entrepreneurship',
                                             'BSHRM', 'Bachelor of Science in Hospitality and Restaurant Management',
                                             'BPA', 'Bachelor of Public Administration',
                                             'business', 'management', 'admin', 'office', 'entrepreneur'],
            'Marketing & Sales'          => ['BSM', 'Bachelor of Science in Marketing',
                                             'BSSM', 'Bachelor of Science in Sales Management',
                                             'BSA', 'Bachelor of Science in Advertising',
                                             'BSPR', 'Bachelor of Science in Public Relations',
                                             'BMM', 'Bachelor of Science in Marketing Management',
                                             'BSPS', 'Bachelor of Science in Professional Sales',
                                             'BSDMA', 'Bachelor of Science in Digital Marketing and Analytics',
                                             'BSIMC', 'Bachelor of Science in Integrated Marketing Communications',
                                             'marketing', 'sales', 'advertising', 'pr', 'market'],
            'Healthcare & Life Sciences' => ['BSHA', 'Bachelor of Science in Healthcare Administration',
                                             'BHI', 'Bachelor of Science in Health Information Management',
                                             'BSPH', 'Bachelor of Science in Public Health',
                                             'BSHA', 'Bachelor of Science in Healthcare Analytics',
                                             'BSHI', 'Bachelor of Science in Health Informatics',
                                             'BSHADM', 'Bachelor of Science in Health Administration',
                                             'BBS', 'Bachelor of Science in Biomedical Science',
                                             'BSB', 'Bachelor of Science in Biotechnology',
                                             'BSM', 'Bachelor of Science in Microbiology',
                                             'BSN', 'Bachelor of Science in Nursing',
                                             'BSPS', 'Bachelor of Science in Pharmaceutical Sciences',
                                             'BSMLS', 'B.S. in Medical Laboratory Science',
                                             'BSK', 'Bachelor of Science in Kinesiology',
                                             'Biotechnology', 'nurse', 'nursing', 'doctor', 'medicine', 'health', 'medical', 'biology'],
            'Education & Training'       => ['BEEd', 'Bachelor of Elementary Education',
                                             'BSEd', 'Bachelor of Secondary Education',
                                             'BECEd', 'Bachelor of Early Childhood Education',
                                             'BPEd', 'Bachelor of Physical Education',
                                             'BSNED', 'Bachelor of Special Needs Education',
                                             'BEdLM', 'Bachelor of Educational Leadership & Management',
                                             'BID', 'Bachelor of Instructional Design',
                                             'BAE', 'Bachelor of Adult Education & Corporate Training',
                                             'BPESS', 'Bachelor of Physical Education and Sports Science',
                                             'BTLEd', 'Bachelor of Technical and Livelihood Education',
                                             'teacher', 'teaching', 'education', 'training', 'pedagogy', 'school'],
            'Finance & Legal'            => ['BSLM', 'Bachelor of Science in Legal Management',
                                             'BSF', 'Bachelor of Science in Finance',
                                             'BSBA', 'Bachelor of Science in Business Administration with a major in Finance',
                                             'BSB', 'Bachelor of Science in Banking',
                                             'BSA', 'Bachelor of Science in Accountancy',
                                             'BSA', 'Bachelor of Science in Auditing',
                                             'BSFB', 'Bachelor of Science in Finance and Business Law',
                                             'accountancy', 'cpa', 'law', 'legal', 'finance', 'banking', 'audit'],
            'Logistics & Supply Chain'   => ['BSSC', 'Bachelor of Science in Supply Chain Management',
                                             'Logistics Management', 'Warehouse Management', 'Operations Management', 'Maritime or Aviation Logistics',
                                             'Transportation Management', 'Inventory Management', 'Procurement Management',
                                             'logistic', 'shipping', 'warehouse', 'supply', 'chain', 'transport'],
            'Human Resources'            => ['BSHRM', 'Bachelor of Science in Human Resource Management',
                                             'BSOD', 'Bachelor of Science in Organizational Development',
                                             'BSIO', 'Bachelor of Science in Industrial-Organizational Psychology',
                                             'Talent Acquisition', 'Employee Relations', 'Compensation and Benefits', 'HR Analytics',
                                             'hr', 'recruitment', 'personnel', 'relations'],
            'Research'                   => ['BSCS', 'science', 'data', 'research', 'analysis', 'laboratory'],
            // --- NEW 'OTHER' CATEGORIES ---
            'Skilled Trades & Construction' => ['carpenter', 'electrician', 'plumber', 'construction', 'welding', 'mechanic', 'engineering', 'masonry'],
            'Hospitality & Tourism'         => ['hotel', 'tourism', 'culinary', 'chef', 'cooking', 'travel', 'restaurant', 'waiter', 'concierge'],
            'Customer Service'              => ['support', 'customer', 'call center', 'helpdesk', 'client service', 'receptionist'],
            'Social & Community Services'   => ['social work', 'non-profit', 'ngo', 'volunteer', 'community', 'counseling', 'psychology'],
            'Agriculture & Environment'     => ['farming', 'agriculture', 'forestry', 'environmental', 'horticulture', 'wildlife', 'sustainability'],
            'Media & Communication'         => ['journalism', 'writer', 'editor', 'content', 'broadcasting', 'media', 'copywriting'],
            'other'                         => ['carpenter', 'electrician', 'plumber', 'construction', 'welding', 'mechanic', 'engineering', 'masonry',
                                                'hotel', 'tourism', 'culinary', 'chef', 'cooking', 'travel', 'restaurant', 'waiter', 'concierge',
                                                'support', 'customer', 'call center', 'helpdesk', 'client service', 'receptionist',
                                                'social work', 'non-profit', 'ngo', 'volunteer', 'community', 'counseling', 'psychology',
                                                'farming', 'agriculture', 'forestry', 'environmental', 'horticulture', 'wildlife', 'sustainability',
                                                'journalism', 'writer', 'editor', 'content', 'broadcasting', 'media', 'copywriting']
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
        return 'Other';
    }
}
