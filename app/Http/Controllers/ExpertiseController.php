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
            'Technology & IT'            => ['bsit', 'bachelor of science in information technology',
                                             'bscs', 'bachelor of science in computer science',
                                             'bsis', 'bachelor of science in information systems',
                                             'bsc', 'bachelor of science in computer engineering',
                                             'bs cybersecurity', 'bachelor of science in cybersecurity',
                                             'bsds', 'bachelor of science in data science',
                                             'bsemc', 'bachelor of science in entertainment and multimedia computing',
                                             'information technology', 'computer', 'software', 'tech', 'programming',
                                             'web', 'network', 'database', 'cybersecurity', 'data science', 'multimedia computing',
                                             'cloud computing', 'artificial intelligence', 'machine learning', 'data analytics', 'software development', 'cybersecurity'],
            'Creative & Design'          => ['bsam', 'bsama', 'bachelor of science in animation multimedia and arts',
                                             'bfa', 'bachelor of fine arts',
                                             'bsma', 'bachelor of science in multimedia arts',
                                             'bama', 'bachelor of arts in multimedia arts',
                                             'bsid', 'bachelor of science in interior design',
                                             'bacd', 'bachelor of arts in creative design',
                                             'bac', 'bachelor of arts in communication',
                                             'bsfdt', 'bachelor of science in fashion design and technology',
                                             'media studies', 'arts', 'design', 'graphic', 'video', 'multimedia', 'animation', 'creative'],
            'Business & Administration'  => ['bba', 'bachelor of business administration',
                                             'bsba', 'bachelor of science in business administration',
                                             'bsb', 'bachelor of science in business',
                                             'bms', 'bachelor of management studies',
                                             'bsa', 'bachelor of science in accountancy',
                                             'bse', 'bachelor of science in entrepreneurship',
                                             'bshrm', 'bachelor of science in hospitality and restaurant management',
                                             'bpa', 'bachelor of public administration',
                                             'business', 'management', 'admin', 'office', 'entrepreneur'],
            'Marketing & Sales'          => ['bsm', 'bachelor of science in marketing',
                                             'bssm', 'bachelor of science in sales management',
                                             'bsa', 'bachelor of science in advertising',
                                             'bspr', 'bachelor of science in public relations',
                                             'bmm', 'bachelor of science in marketing management',
                                             'bspS', 'bachelor of science in professional sales',
                                             'bsdma', 'bachelor of science in digital marketing and analytics',
                                             'bsimc', 'bachelor of science in integrated marketing communications',
                                             'marketing', 'sales', 'advertising', 'pr', 'market'],
            'Healthcare & Life Sciences' => ['bsha', 'bachelor of science in healthcare administration',
                                             'bhi', 'bachelor of science in health information management',
                                             'bspH', 'bachelor of science in public health',
                                             'bsha', 'bachelor of science in healthcare analytics',
                                             'bshi', 'bachelor of science in health informatics',
                                             'bshadm', 'bachelor of science in health administration',
                                             'bbs', 'bachelor of science in biomedical science',
                                             'bsb', 'bachelor of science in biotechnology',
                                             'bsm', 'bachelor of science in microbiology',
                                             'bsn', 'bachelor of science in nursing',
                                             'bsps', 'bachelor of science in pharmaceutical sciences',
                                             'bsmls', 'bachelor of science in medical laboratory science',
                                             'bsk', 'bachelor of science in kinesiology',
                                             'biotechnology', 'nurse', 'nursing', 'doctor', 'medicine', 'health', 'medical', 'biology'],
            'Education & Training'       => ['beed', 'bachelor of elementary education',
                                             'bsed', 'bachelor of secondary education',
                                             'beced', 'bachelor of early childhood education',
                                             'bped', 'bachelor of physical education',
                                             'bsned', 'bachelor of special needs education',
                                             'bedlm', 'bachelor of educational leadership & management',
                                             'bid', 'bachelor of instructional design',
                                             'bae', 'bachelor of adult education & corporate training',
                                             'bpress', 'bachelor of physical education and sports science',
                                             'btled', 'bachelor of technical and liveliness education',
                                             'teacher', 'teaching', 'education', 'training', 'pedagogy', 'school'],
            'Finance & Legal'            => ['bslm', 'bachelor of science in legal management',
                                             'bsf', 'bachelor of science in finance',
                                             'bsba', 'bachelor of science in business administration with a major in finance',
                                             'bsb', 'bachelor of science in banking',
                                             'bsa', 'bachelor of science in accountancy',
                                             'bsa', 'bachelor of science in auditing',
                                             'bsfb', 'bachelor of science in finance and business law',
                                             'accountancy', 'cpa', 'law', 'legal', 'finance', 'banking', 'audit'],
            'Logistics & Supply Chain'   => ['bssc', 'bachelor of science in supply chain management',
                                             'logistics management', 'warehouse management', 'operations management', 'maritime or aviation logistics',
                                             'transportation management', 'inventory management', 'procurement management',
                                             'logistic', 'shipping', 'warehouse', 'supply', 'chain', 'transport'],
            'Human Resources'            => ['bshrm', 'bachelor of science in human resource management',
                                             'bsod', 'bachelor of science in organizational development',
                                             'bsio', 'bachelor of science in industrial-organizational psychology',
                                             'talent acquisition', 'employee relations', 'compensation and benefits', 'hr analytics',
                                             'hr', 'recruitment', 'personnel', 'relations'],
            'Research'                   => ['bscs', 'bachelor of science', 'data', 'research', 'analysis', 'laboratory'],
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
