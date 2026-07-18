<?php

namespace Database\Seeders;

use App\Models\Expertise;
use App\Models\Course;
use App\Models\CourseAlias;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseExpertiseSeeder extends Seeder
{
    public function run(): void
    {
        // Truncate tables to avoid duplicates if re-running (Disable FK checks first)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        CourseAlias::truncate();
        Course::truncate();
        Expertise::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. Unified Master Category Map Structure
        $mappingMatrix = [
            'Technology & IT' => [
                'code' => 'TECH',
                'skills' => [
                    // Vocational Skills
                    'Computer Systems Servicing NC II (CSS NC II)', 'Visual Graphic Design NC III (VGD NC III)',
                    'Technical Drafting NC II', 'Broadband Installation (Fixed Wireless Systems) NC II',
                    'Telecom OSP Installation (Fiber Optic Cable) NC II', 'Contact Center Services NC II',
                    'Web Development NC III', 'Animation NC II', 'Illustration NC II',
                    'Programming (.NET Technology) NC III', 'Programming (Java) NC III', 'Programming (Oracle Database) NC III',
                    // Associate & Bachelor Skills
                    'information technology', 'computer science', 'information systems', 'cybersecurity', 'data science',
                    'programming', 'software development', 'web developer', 'network administrator', 'full-stack development',
                    'mobile application development', 'cloud computing', 'database management', 'machine learning',
                    'artificial intelligence', 'ui/ux design', 'network security', 'devops', 'software engineering',
                    'data analytics', 'game development', 'system administration', 'it support', 'natural language processing',
                    'deep learning', 'cloud architecture', 'blockchain development', 'smart contract programming',
                    'it governance', 'enterprise architecture', 'information audit', 'digital forensics', 'ethical hacking',
                    'penetration testing', 'embedded systems', 'robotics processing automation', 'internet of things',
                    'computer systems servicing', 'hardware troubleshooting', 'digital curation', 'metadata management',
                    'database administration'
                ],
                'courses' => [
                    'vocational' => [
                        'Computer Systems Servicing (CSS)' => ['css', 'computer systems servicing', 'computer hardware and software'],
                        'Visual Graphic Design (VGD)'      => ['vgd', 'visual graphic design', 'graphic design'],
                        'Illustration'                     => ['illustration', 'illustrator', 'digital art'],
                        'Animation'                        => ['animation', '2d animation', '3d animation', 'animator'],
                    ],
                    'associate' => [
                        'Associate in Computer Technology' => ['act', 'associate computer technology', 'computer technology'],
                        'Associate of Science in Computer Science' => ['ascs', 'associate computer science', 'as in computer science'],
                        'Associate in Information Technology' => ['ait', 'associate information technology', 'as in information technology'],
                        'Associate of Science in Cybersecurity' => ['associate cybersecurity', 'cybersecurity diploma', 'information security'],
                        'Associate in Network Administration' => ['associate network administration', 'computer networking diploma'],
                        'Associate in Software Development' => ['associate software development', 'programming diploma', 'web development'],
                        'Associate of Science in Data Analytics' => ['associate data analytics', 'data science diploma'],
                        'Diploma in Computer Systems Servicing' => ['css', 'computer systems servicing', 'hardware troubleshooting'],
                    ],
                    'bachelor' => [
                        'Bachelor of Science in Information Technology' => ['bsit', 'information technology'],
                        'Bachelor of Science in Computer Science' => ['bscs', 'computer science'],
                        'Bachelor of Science in Information Systems' => ['bsis', 'information systems'],
                        'Bachelor of Science in Entertainment and Multimedia Computing' => ['bsemc', 'multimedia arts', 'animation', 'game development'],
                        'Bachelor of Science in Cybersecurity' => ['bsc', 'cybersecurity', 'information security'],
                        'Bachelor of Science in Data Science' => ['bsds', 'data science', 'data analytics']
                    ]
                ]
            ],
            'Finance & Legal' => [
                'code' => 'FIN',
                'skills' => [
                    'accounting', 'accountancy', 'auditing', 'finance', 'banking', 'legal management', 'lawyer', 'cpa',
                    'financial analysis', 'taxation', 'bookkeeping', 'management accounting', 'forensic accounting',
                    'budgeting', 'cost accounting', 'financial forecasting', 'risk management', 'investment banking',
                    'portfolio management', 'wealth management', 'credit analysis', 'actuarial valuation',
                    'treasury management', 'payroll processing', 'public fiscal administration', 'revenue auditing',
                    'legal research', 'legal drafting', 'litigation support', 'contract management', 'corporate compliance',
                    'labor relations', 'regulatory affairs', 'paralegal services', 'alternative dispute resolution',
                    'intellectual property protection', 'court stenography', 'judicial administration', 'notarial services',
                    'tax law advisory', 'customs brokerage', 'commercial arbitration', 'legislative drafting'
                ],
                'courses' => [
                    'associate' => [
                        'Associate in Accounting Technology' => ['aat', 'associate accounting technology', 'bookkeeping course'],
                        'Associate of Science in Accounting' => ['asa', 'associate science accounting', 'junior accountant'],
                        'Associate in Legal Management' => ['alm', 'associate legal management', 'paralegal track'],
                        'Associate of Science in Paralegal Studies' => ['asps', 'paralegal services', 'legal assistant'],
                        'Associate in Business Administration major in Finance' => ['abaf', 'associate finance', 'banking and finance'],
                        'Diploma in Bookkeeping' => ['diploma bookkeeping', 'nc iii bookkeeping', 'payroll processing'],
                        'Certificate in Court Stenography' => ['court stenography', 'stenographer course', 'judicial administration'],
                    ],
                    'bachelor' => [
                        'Bachelor of Science in Accountancy' => ['bsa', 'accountancy', 'accounting degree'],
                        'Bachelor of Science in Legal Management' => ['bslm', 'legal management track']
                    ]
                ]
            ],
            'Business & Administration' => [
                'code' => 'BUS',
                'skills' => [
                    'Contact Center Services NC II', 'Customer Services NC II', 'Customer Service Representative NC II',
                    'business administration', 'hospitality management', 'public administration', 'entrepreneurship', 'management studies', 'office administration',
                    'human resources', 'marketing', 'sales', 'operations management', 'strategic planning', 'business analytics',
                    'supply chain management', 'project management', 'financial management', 'organizational behavior',
                    'business communication', 'leadership development', 'customer relationship management',
                    'business law and ethics', 'international business', 'e-commerce management', 'retail management',
                    'event planning and management', 'business intelligence', 'corporate governance', 'risk assessment',
                    'performance management', 'change management', 'business development', 'logistics planning', 'procurement',
                    'inventory management', 'franchise management', 'digital marketing', 'social media management', 'search engine optimization', 'sales management',
                    'market research', 'brand management', 'public relations', 'content marketing', 'advertising strategy',
                    'human resource management', 'talent acquisition', 'employee relations', 'payroll administration',
                    'training and development', 'organizational development', 'labor compliance', 'executive assistance', 'records management', 'data entry', 'business correspondence',
                    'front office operations', 'event planning', 'customer service excellence', 'transcription',
                    'call center operations', 'virtual assistance', 'billing and collection', 'office productivity software'
                ],
                'courses' => [
                    'vocational' => [
                        'Contact Center Services (CCS)' => ['ccs', 'contact center services', 'customer service'],
                        'Customer Services'             => ['customer services', 'customer support'],
                        'Customer Service Representative' => ['customer service representative', 'csr']
                    ],
                    'associate' => [
                        'Associate in Business Administration' => ['aba', 'associate business administration', 'business management diploma'],
                        'Associate in Office Administration' => ['aoa', 'associate office administration', 'executive assistant course'],
                        'Associate in Entrepreneurship' => ['associate entrepreneurship', 'diploma entrepreneurship', 'small business management'],
                        'Diploma in Human Resource Management' => ['diploma hr', 'hr management diploma', 'talent acquisition course'],
                        'Diploma in Marketing Management' => ['diploma marketing', 'digital marketing certificate', 'sales management course'],
                        'Diploma in Supply Chain and Logistics' => ['diploma supply chain', 'logistics planning', 'procurement course'],
                        'Certificate in Virtual Assistance' => ['virtual assistance', 'va certificate', 'call center operations'],
                    ]
                ]
            ],
            'Automotive & Land Transportation' => [
                'code' => 'ALT',
                'skills' => [
                    'Automotive Servicing NC I', 'Automotive Servicing NC II', 'Automotive Servicing NC III', 'Automotive Servicing NC IV',
                    'Driving NC II', 'Driving (Passenger Bus/Heavy Vehicle) NC III', 'Motorcycle and Small Engine Servicing NC II'
                ],
                'courses' => [
                    'vocational' => [
                        'Automotive Servicing'                  => ['automotive servicing', 'car repair', 'mechanic', 'auto electrical'],
                        'Driving'                               => ['driving', 'light vehicle driving', 'heavy vehicle driving', 'truck driving'],
                        'Motorcycle and Small Engine Servicing' => ['motorcycle servicing', 'small engine repair', 'motorcycle mechanic']
                    ]
                ]
            ],
            'Tourism, Hospitality, & Culinary' => [
                'code' => 'THC',
                'skills' => [
                    'Cookery NC II', 'Commercial Cooking NC III', 'Commercial Cooking NC IV', 'Food and Beverage Services NC II',
                    'Food and Beverage Services NC III', 'Bread and Pastry Production NC II', 'Housekeeping NC II', 'Housekeeping NC III',
                    'Bartending NC II', 'Barista NC II', 'Front Office Services NC II',
                    'tourism management', 'hospitality operations', 'culinary arts', 'event planning', 'travel agency operations', 'hotel management', 'restaurant management',
                    'tour guiding', 'customer service', 'sales and marketing', 'human resources', 'financial management', 'strategic planning', 'quality assurance',
                    'food and beverage service', 'front office operations', 'housekeeping management', 'revenue management', 'hospitality law and ethics',
                    'culinary techniques', 'menu planning', 'food safety and sanitation', 'nutrition and dietetics', 'pastry and baking', 'beverage management', 'culinary innovation',
                    'culinary entrepreneurship', 'culinary presentation and plating', 'culinary event management', 'culinary nutrition', 'culinary sustainability', 'culinary research and development',
                    'culinary technology', 'culinary business management', 'culinary marketing', 'culinary operations management', 'culinary leadership', 'culinary team management',
                    'culinary cost control', 'culinary menu engineering', 'culinary food styling', 'culinary sensory evaluation', 'culinary international cuisine', 'culinary cultural gastronomy',
                    'culinary food trends', 'culinary food photography', 'culinary food writing', 'culinary food science', 'culinary food innovation', 'culinary food entrepreneurship',
                ],
                'courses' => [
                    'vocational' => [
                        'Cookery'                           => ['cookery', 'culinary arts', 'cooking', 'chef'],
                        'Food and Beverage Services (FBS)'  => ['fbs', 'food and beverage services', 'waiter', 'waitress'],
                        'Bread and Pastry Production (BPP)' => ['bpp', 'bread and pastry production', 'baking', 'baker'],
                        'Housekeeping'                      => ['housekeeping', 'room attendant', 'hotel maintenance'],
                        'Bartending'                        => ['bartending', 'barista', 'mixology', 'coffee making']
                    ],
                    'associate' => [
                        'Associate in Tourism Management' => ['atm', 'associate tourism', 'travel agency operations', 'tour guiding'],
                        'Associate in Hospitality Management' => ['ahm', 'associate hospitality', 'hotel management', 'front office operations'],
                        'Associate in Hotel and Restaurant Management' => ['ahrm', 'hrm', 'housekeeping management', 'food and beverage service'],
                        'Diploma in Culinary Arts' => ['diploma culinary', 'culinary techniques', 'menu planning'],
                        'Associate in Commercial Cookery' => ['commercial cookery', 'culinary operations management', 'culinary cost control'],
                        'Diploma in Baking and Pastry Arts' => ['pastry and baking', 'baking arts', 'baking diploma'],
                        'Certificate in Tour Guiding Services' => ['tour guiding', 'travel services', 'guiding certificate'],
                        'Certificate in Food and Beverage Services' => ['f&b service', 'food beverage service', 'beverage management'],
                    ]
                ]
            ],
            'Construction & Mechanical Trades' => [
                'code' => 'CMT',
                'skills' => [
                    'Shielded Metal Arc Welding (SMAW) NC I', 'Shielded Metal Arc Welding (SMAW) NC II', 'Shielded Metal Arc Welding (SMAW) NC III',
                    'Flux Cored Arc Welding (FCAW) NC II', 'Gas Metal Arc Welding (GMAW) NC II', 'Electrical Installation and Maintenance (EIM) NC II',
                    'Electrical Installation and Maintenance (EIM) NC III', 'Plumbing NC II', 'Plumbing NC III', 'Carpentry NC II', 'Carpentry NC III'
                ],
                'courses' => [
                    'vocational' => [
                        'Shielded Metal Arc Welding (SMAW)'            => ['smaw', 'welding', 'welder', 'arc welding'],
                        'Electrical Installation and Maintenance (EIM)' => ['eim', 'electrical installation', 'electrician', 'house wiring'],
                        'Plumbing'                                      => ['plumbing', 'plumber', 'pipefitting'],
                        'Carpentry'                                     => ['carpentry', 'carpenter', 'woodworking']
                    ]
                ]
            ],
            'Health, Beauty, & Wellness' => [
                'code' => 'HBW',
                'skills' => [
                    'Caregiving NC II', 'Caregiving (Grade Schooler/Adolescent) NC III', 'Hairdressing NC II', 'Hairdressing NC III',
                    'Beauty Care (Nail Care) NC II', 'Beauty Care NC III', 'Massage Therapy NC II'
                ],
                'courses' => [
                    'vocational' => [
                        'Caregiving'      => ['caregiving', 'caregiver', 'patient care', 'elderly care'],
                        'Hairdressing'    => ['hairdressing', 'hair stylist', 'salon management'],
                        'Beauty Care'     => ['beauty care', 'esthetics', 'makeup artist', 'nail technician'],
                        'Massage Therapy' => ['massage therapy', 'masseur', 'masseuse', 'spa therapist']
                    ]
                ]
            ],
            'Education & Training' => [
                'code' => 'EDUC',
                'skills' => [
                    'elementary education', 'secondary education', 'early childhood', 'physical education', 'special needs education', 'teacher', 'instructional design',
                    'curriculum development', 'educational technology', 'classroom management', 'assessment and evaluation',
                    'pedagogy', 'learning theories', 'educational psychology', 'literacy development', 'numeracy skills',
                    'language acquisition', 'multicultural education', 'inclusive education', 'educational leadership',
                    'professional development', 'mentoring and coaching', 'educational research', 'instructional strategies',
                    'educational policy', 'school administration', 'student engagement', 'educational assessment tools',
                    'special education strategies', 'behavior management techniques', 'differentiated instruction',
                    'educational software proficiency', 'online teaching methodologies', 'blended learning approaches',
                    'classroom technology integration', 'lesson planning and design', 'student-centered learning approaches',
                    'formative and summative assessment techniques'
                ],
                'courses' => [
                    'associate' => [
                        'Associate in Early Childhood Education' => ['aece', 'early childhood development', 'preschool teacher'],
                        'Associate of Arts in Elementary Education' => ['aaee', 'associate elementary education', 'teaching assistant'],
                        'Associate of Arts in Secondary Education' => ['aase', 'associate secondary education', 'high school tutor'],
                        'Associate in Special Education Studies' => ['ased', 'special needs assistant', 'inclusive education diploma'],
                        'Diploma in Instructional Design and Technology' => ['diploma instructional design', 'educational technology', 'online teaching methodologies'],
                        'Diploma in Physical Education and Sports Coaching' => ['diploma physical education', 'pe teaching assistant', 'sports coaching'],
                        'Certificate in Teaching Proficiency' => ['ctp', 'certificate in teaching', 'pedagogy certificate'],
                    ]
                ]
            ]
        ];

        // 2. Loop through and execute database mapping transactions cleanly
        foreach ($mappingMatrix as $areaName => $data) {

            // Deduplicate and safely clean skills list
            $uniqueSkills = array_values(array_unique(array_map('trim', $data['skills'])));

            // Create the primary expertise entry
            $expertise = Expertise::create([
                'exp_code'          => $data['code'],
                'area_of_expertise' => $areaName,
                'skills'            => json_encode($uniqueSkills) // Ensure JSON structure
            ]);

            // Loop through each educational milestone structure
            foreach ($data['courses'] as $level => $coursesList) {
                foreach ($coursesList as $courseName => $aliases) {

                    // Create Course linked directly to the parent expertise row
                    $course = Course::create([
                        'expertise_id' => $expertise->id,
                        'display_name' => $courseName,
                        'educ_level'   => $level
                    ]);

                    // Seed matching aliases for search optimization
                    foreach ($aliases as $alias) {
                        CourseAlias::create([
                            'course_id' => $course->id,
                            'alias_keyword'     => trim($alias)
                        ]);
                    }
                }
            }
        }
    }
}
// class CourseExpertiseSeeder extends Seeder
// {
//     public function run(): void
//     {
//         // Truncate tables to avoid duplicates if re-running (Disable FK checks first)
//         DB::statement('SET FOREIGN_KEY_CHECKS=0;');
//         CourseAlias::truncate();
//         Course::truncate();
//         Expertise::truncate();
//         DB::statement('SET FOREIGN_KEY_CHECKS=1;');

//         // 1. Define your initial hardcoded map data
//         $mappingMatrix = [
//             'Information & Communications Technology' => [
//                 'educ_level' => 'vocational',
//                 'code'       => 'ICT',
//                 'skills' => [
//                     'Computer Systems Servicing NC II (CSS NC II)', 'Visual Graphic Design NC III (VGD NC III)',
//                     'Technical Drafting NC II', 'Broadband Installation (Fixed Wireless Systems) NC II',
//                     'Telecom OSP Installation (Fiber Optic Cable) NC II', 'Contact Center Services NC II',
//                     'Web Development NC III', 'Animation NC II', 'Illustration NC II',
//                     'Programming (.NET Technology) NC III', 'Programming (Java) NC III', 'Programming (Oracle Database) NC III'
//                 ],
//                 'courses' => [
//                     'Computer Systems Servicing (CSS)' => ['css', 'computer systems servicing', 'computer hardware and software'],
//                     'Visual Graphic Design (VGD)_'      => ['vgd', 'visual graphic design', 'graphic design'],
//                 ]
//             ],
//             'Visual Graphic Design' => [
//                 'educ_level' => 'vocational',
//                 'code'       => 'VGD',
//                 'skills' => [
//                     'Visual Graphic Design NC III', 'Illustration NC II', 'Animation NC II',
//                     'Animation NC III', '2D Animation NC III', '3D Animation NC III',
//                     'Photography NC II', 'Web Development NC III', 'Adobe Certified Professional (ACP) - Photoshop/Illustrator'
//                 ],
//                 'courses' => [
//                     'Visual Graphic Design (VGD)' => ['vgd', 'visual graphic design', 'graphic design'],
//                     'Illustration'                => ['illustration', 'illustrator', 'digital art'],
//                     'Animation'                   => ['animation', '2d animation', '3d animation', 'animator'],
//                 ]
//             ],
//             'Contact Center Services' => [
//                 'educ_level'   => 'vocational',
//                 'code'         => 'CCS',
//                 'skills' => [
//                     'Contact Center Services NC II',
//                     'Customer Services NC II',
//                     'Customer Service Representative NC II',

//                 ],
//                 'courses'      => [
//                     'Contact Center Services (CCS)' => ['ccs', 'contact center services', 'customer service'],
//                     'Customer Services'             => ['customer services', 'customer support'],
//                     'Customer Service Representative' => ['customer service representative', 'csr']
//                 ]
//             ],
//             'Automotive & Land Transportation' => [
//                 'educ_level'   => 'vocational',
//                 'code'         => 'ALT',
//                 'skills' => [
//                     'Automotive Servicing NC I',
//                     'Automotive Servicing NC II',
//                     'Automotive Servicing NC III',
//                     'Automotive Servicing NC IV',
//                     'Driving NC II',
//                     'Driving (Passenger Bus/Heavy Vehicle) NC III',
//                     'Motorcycle and Small Engine Servicing NC II',
//                 ],
//                 'courses'      => [
//                     'Automotive Servicing'                  => ['automotive servicing', 'car repair', 'mechanic', 'auto electrical'],
//                     'Driving'                               => ['driving', 'light vehicle driving', 'heavy vehicle driving', 'truck driving'],
//                     'Motorcycle and Small Engine Servicing' => ['motorcycle servicing', 'small engine repair', 'motorcycle mechanic']
//                 ]
//             ],
//             'Tourism, Hospitality, & Culinary' => [
//                 'educ_level'   => 'vocational',
//                 'code'         => 'THC',
//                 'skills' => [
//                     'Cookery NC II',
//                     'Commercial Cooking NC III',
//                     'Commercial Cooking NC IV',
//                     'Food and Beverage Services NC II',
//                     'Food and Beverage Services NC III',
//                     'Bread and Pastry Production NC II',
//                     'Housekeeping NC II',
//                     'Housekeeping NC III',
//                     'Bartending NC II',
//                     'Barista NC II',
//                     'Front Office Services NC II',
//                 ],
//                 'courses'      => [
//                     'Cookery'                            => ['cookery', 'culinary arts', 'cooking', 'chef'],
//                     'Food and Beverage Services (FBS)'  => ['fbs', 'food and beverage services', 'waiter', 'waitress'],
//                     'Bread and Pastry Production (BPP)' => ['bpp', 'bread and pastry production', 'baking', 'baker'],
//                     'Housekeeping'                       => ['housekeeping', 'room attendant', 'hotel maintenance'],
//                     'Bartending'                         => ['bartending', 'barista', 'mixology', 'coffee making']
//                 ]
//             ],
//             'Construction & Mechanical Trades' => [
//                 'educ_level'   => 'vocational',
//                 'code'         => 'CMT',
//                 'skills' => [
//                     'Shielded Metal Arc Welding (SMAW) NC I',
//                     'Shielded Metal Arc Welding (SMAW) NC II',
//                     'Shielded Metal Arc Welding (SMAW) NC III',
//                     'Flux Cored Arc Welding (FCAW) NC II',
//                     'Gas Metal Arc Welding (GMAW) NC II',
//                     'Electrical Installation and Maintenance (EIM) NC II',
//                     'Electrical Installation and Maintenance (EIM) NC III',
//                     'Plumbing NC II',
//                     'Plumbing NC III',
//                     'Carpentry NC II',
//                     'Carpentry NC III',
//                 ],
//                 'courses'      => [
//                     'Shielded Metal Arc Welding (SMAW)'              => ['smaw', 'welding', 'welder', 'arc welding'],
//                     'Electrical Installation and Maintenance (EIM)' => ['eim', 'electrical installation', 'electrician', 'house wiring'],
//                     'Plumbing'                                       => ['plumbing', 'plumber', 'pipefitting'],
//                     'Carpentry'                                      => ['carpentry', 'carpenter', 'woodworking']
//                 ]
//             ],
//             'Health, Beauty, & Wellness' => [
//                 'educ_level'   => 'vocational',
//                 'code'         => 'HBW',
//                 'skills' => [
//                     'Caregiving NC. II',
//                     'Caregiving (Grade Schooler/Adolescent) NC III',
//                     'Hairdressing NC II',
//                     'Hairdressing NC III',
//                     'Beauty Care (Nail Care) NC II',
//                     'Beauty Care NC III',
//                     'Massage Therapy NC II',
//                 ],
//                 'courses'      => [
//                     'Caregiving'      => ['caregiving', 'caregiver', 'patient care', 'elderly care'],
//                     'Hairdressing'    => ['hairdressing', 'hair stylist', 'salon management'],
//                     'Beauty Care'     => ['beauty care', 'esthetics', 'makeup artist', 'nail technician'],
//                     'Massage Therapy' => ['massage therapy', 'masseur', 'masseuse', 'spa therapist']
//                 ]
//             ],

//             'Associate Technology & IT' => [
//                 'educ_level' => 'associate',
//                 'code' => 'ATECH',
//                 'skills' => [
//                     'information technology', 'computer science', 'information systems',
//                     'cybersecurity', 'data science', 'programming', 'software development', 'web developer',
//                     'network administrator', 'full-stack development', 'mobile application development',
//                     'cloud computing', 'database management', 'machine learning', 'artificial intelligence',
//                     'ui/ux design', 'network security', 'devops', 'software engineering', 'data analytics',
//                     'game development', 'system administration', 'it support', 'natural language processing', 'deep learning', 'cloud architecture', 'blockchain development',
//                     'smart contract programming', 'it governance', 'enterprise architecture', 'information audit',
//                     'digital forensics', 'ethical hacking', 'penetration testing', 'embedded systems',
//                     'robotics processing automation', 'internet of things', 'computer systems servicing',
//                     'hardware troubleshooting', 'digital curation', 'metadata management', 'database administration'
//                 ],
//                 'courses' => [
//                     'Associate in Computer Technology' => ['act', 'associate computer technology', 'computer technology'],
//                     'Associate of Science in Computer Science' => ['ascs', 'associate computer science', 'as in computer science'],
//                     'Associate in Information Technology' => ['ait', 'associate information technology', 'as in information technology'],
//                     'Associate of Science in Cybersecurity' => ['associate cybersecurity', 'cybersecurity diploma', 'information security'],
//                     'Associate in Network Administration' => ['associate network administration', 'computer networking diploma'],
//                     'Associate in Software Development' => ['associate software development', 'programming diploma', 'web development'],
//                     'Associate of Science in Data Analytics' => ['associate data analytics', 'data science diploma'],
//                     'Diploma in Computer Systems Servicing' => ['css', 'computer systems servicing', 'hardware troubleshooting'],
//                 ]
//             ],
//             'Associate Finance & Legal' => [
//                 'educ_level' => 'associate',
//                 'code' => 'AFIN',
//                 'skills' => [
//                     'accounting', 'accountancy', 'auditing', 'finance', 'banking', 'legal management', 'lawyer', 'cpa',
//                     'financial analysis', 'taxation', 'bookkeeping', 'management accounting', 'forensic accounting',
//                     'budgeting', 'cost accounting', 'financial forecasting', 'risk management', 'investment banking',
//                     'portfolio management', 'wealth management', 'credit analysis', 'actuarial valuation',
//                     'treasury management', 'payroll processing', 'public fiscal administration', 'revenue auditing',
//                     'legal research', 'legal drafting', 'litigation support', 'contract management', 'corporate compliance',
//                     'labor relations', 'regulatory affairs', 'paralegal services', 'alternative dispute resolution',
//                     'intellectual property protection', 'court stenography', 'judicial administration', 'notarial services',
//                     'tax law advisory', 'customs brokerage', 'commercial arbitration', 'legislative drafting'
//                 ],
//                 'courses' => [
//                     'Associate in Accounting Technology' => ['aat', 'associate accounting technology', 'bookkeeping course'],
//                     'Associate of Science in Accounting' => ['asa', 'associate science accounting', 'junior accountant'],
//                     'Associate in Legal Management' => ['alm', 'associate legal management', 'paralegal track'],
//                     'Associate of Science in Paralegal Studies' => ['asps', 'paralegal services', 'legal assistant'],
//                     'Associate in Business Administration major in Finance' => ['abaf', 'associate finance', 'banking and finance'],
//                     'Diploma in Bookkeeping' => ['diploma bookkeeping', 'nc iii bookkeeping', 'payroll processing'],
//                     'Certificate in Court Stenography' => ['court stenography', 'stenographer course', 'judicial administration'],
//                 ]
//             ],
//             'Associate Business & Administration' => [
//                 'educ_level' => 'associate',
//                 'code' => 'ABUS',
//                 'skills' => [
//                     'business administration', 'hospitality management', 'public administration', 'entrepreneurship', 'management studies', 'office administration',
//                     'human resources', 'marketing', 'sales', 'operations management', 'strategic planning', 'business analytics',
//                     'supply chain management', 'project management', 'financial management', 'organizational behavior',
//                     'business communication', 'leadership development', 'customer relationship management',
//                     'business law and ethics', 'international business', 'e-commerce management', 'retail management',
//                     'event planning and management', 'business intelligence', 'corporate governance', 'risk assessment',
//                     'performance management', 'change management', 'project management', 'operations management', 'strategic planning', 'business development',
//                     'change management', 'supply chain management', 'logistics planning', 'procurement',
//                     'inventory management', 'franchise management', 'risk assessment', 'corporate governance',
//                     'digital marketing', 'social media management', 'search engine optimization', 'sales management',
//                     'market research', 'brand management', 'public relations', 'customer relationship management',
//                     'e-commerce management', 'b2b sales', 'content marketing', 'advertising strategy',
//                     'human resource management', 'talent acquisition', 'employee relations', 'payroll administration',
//                     'performance management', 'training and development', 'organizational development', 'labor compliance',
//                     'executive assistance', 'records management', 'data entry', 'business correspondence',
//                     'front office operations', 'event planning', 'customer service excellence', 'transcription',
//                     'call center operations', 'virtual assistance', 'billing and collection', 'office productivity software'
//                 ],
//                 'courses' => [
//                     'Associate in Business Administration' => ['aba', 'associate business administration', 'business management diploma'],
//                     'Associate in Office Administration' => ['aoa', 'associate office administration', 'executive assistant course'],
//                     'Associate in Entrepreneurship' => ['associate entrepreneurship', 'diploma entrepreneurship', 'small business management'],
//                     'Diploma in Human Resource Management' => ['diploma hr', 'hr management diploma', 'talent acquisition course'],
//                     'Diploma in Marketing Management' => ['diploma marketing', 'digital marketing certificate', 'sales management course'],
//                     'Diploma in Supply Chain and Logistics' => ['diploma supply chain', 'logistics planning', 'procurement course'],
//                     'Certificate in Virtual Assistance' => ['virtual assistance', 'va certificate', 'call center operations'],
//                 ]
//             ],
//             'Associate Education & Training' => [
//                 'educ_level' => 'associate',
//                 'code' => 'AEDUC',
//                 'skills' => [
//                     'elementary education', 'secondary education', 'early childhood', 'physical education', 'special needs education', 'teacher', 'instructional design',
//                     'curriculum development', 'educational technology', 'classroom management', 'assessment and evaluation',
//                     'pedagogy', 'learning theories', 'educational psychology', 'literacy development', 'numeracy skills',
//                     'language acquisition', 'multicultural education', 'inclusive education', 'educational leadership',
//                     'professional development', 'mentoring and coaching', 'educational research', 'instructional strategies',
//                     'educational policy', 'school administration', 'student engagement', 'educational assessment tools',
//                     'special education strategies', 'behavior management techniques', 'differentiated instruction',
//                     'educational software proficiency', 'online teaching methodologies', 'blended learning approaches',
//                     'classroom technology integration', 'lesson planning and design', 'student-centered learning approaches',
//                     'formative and summative assessment techniques'
//                 ],
//                 'courses' => [
//                     'Associate in Early Childhood Education' => ['aece', 'early childhood development', 'preschool teacher'],
//                     'Associate of Arts in Elementary Education' => ['aaee', 'associate elementary education', 'teaching assistant'],
//                     'Associate of Arts in Secondary Education' => ['aase', 'associate secondary education', 'high school tutor'],
//                     'Associate in Special Education Studies' => ['ased', 'special needs assistant', 'inclusive education diploma'],
//                     'Diploma in Instructional Design and Technology' => ['diploma instructional design', 'educational technology', 'online teaching methodologies'],
//                     'Diploma in Physical Education and Sports Coaching' => ['diploma physical education', 'pe teaching assistant', 'sports coaching'],
//                     'Certificate in Teaching Proficiency' => ['ctp', 'certificate in teaching', 'pedagogy certificate'],
//                 ]
//             ],
//             'Associate Healthcare & Life Sciences' => [
//                 'educ_level' => 'associate',
//                 'code' => 'AHEAL',
//                 'skills' => [
//                     'nursing', 'medical laboratory', 'pharmaceutical', 'public health', 'midwifery', 'radiologic technology', 'biology', 'microbiology',
//                     'anatomy', 'physiology', 'biochemistry', 'genetics', 'immunology', 'pathology', 'pharmacology',
//                     'epidemiology', 'healthcare management', 'clinical research', 'medical ethics', 'patient care',
//                     'health informatics', 'biostatistics', 'toxicology', 'virology', 'parasitology',
//                     'molecular biology', 'cell biology', 'neuroscience', 'biophysics', 'bioinformatics',
//                     'environmental health', 'occupational health', 'nutrition science', 'gerontology',
//                     'rehabilitation sciences', 'health policy and administration', 'medical imaging', 'surgical technology', 'emergency medical services', 'phlebotomy', 'cardiovascular technology',
//                     'respiratory therapy', 'anesthesia technology', 'dental hygiene', 'optometry', 'speech-language pathology',
//                     'audiology', 'occupational therapy', 'physical therapy', 'veterinary technology', 'clinical laboratory science',
//                     'medical coding and billing', 'healthcare quality management', 'healthcare compliance', 'healthcare data analytics',
//                     'telemedicine', 'healthcare innovation', 'biomedical engineering', 'genomic medicine', 'personalized medicine', 'regenerative medicine',
//                     'stem cell research', 'nanomedicine', 'pharmacogenomics', 'healthcare entrepreneurship', 'medical device development',
//                     'healthcare policy analysis', 'global health initiatives', 'community health education', 'health'
//                 ],
//                 'courses' => [
//                     'Associate in Health Science Education' => ['ahse', 'health science education', 'pre-nursing'],
//                     'Graduate in Midwifery' => ['gm', 'midwifery', 'midwife course'],
//                     'Associate in Radiologic Technology' => ['art', 'radiologic technology', 'x-ray tech diploma'],
//                     'Diploma in Medical Laboratory Technology' => ['dmlt', 'medical laboratory', 'clinical laboratory technician'],
//                     'Diploma in Pharmacy Technology' => ['dpt', 'pharmacy technician', 'pharmaceutical assistant'],
//                     'Associate in Emergency Medical Services' => ['ems', 'paramedic course', 'emergency medical technician'],
//                     'Diploma in Dental Hygiene' => ['ddh', 'dental hygiene', 'dental assistant'],
//                     'Certificate in Phlebotomy Technology' => ['phlebotomy', 'phlebotomist certificate', 'blood collection'],
//                     'Associate in Healthcare Administration' => ['medical coding and billing', 'healthcare compliance', 'health informatics'],
//                 ]
//             ],
//             'Associate Engineering & Architecture' => [
//                 'educ_level' => 'associate',
//                 'code' => 'AENG',
//                 'skills' => [
//                     'structural design', 'AutoCAD', 'blueprint reading', 'project estimation', 'site inspection', 'HVAC design',
//                     'plumbing systems', 'electrical systems', 'civil engineering', 'mechanical engineering', 'architectural design',
//                     'construction management', 'geotechnical engineering', 'transportation engineering', 'environmental engineering', 'industrial engineering', 'chemical engineering', 'aerospace engineering', 'marine engineering',
//                     'mining engineering', 'petroleum engineering', 'industrial design', 'landscape architecture',
//                     'structural engineering', 'transportation engineering', 'mechatronics engineering', 'geodetic engineering', 'electronics engineering', 'electrical engineering', 'materials science', 'robotics', 'automation', 'thermodynamics', 'fluid mechanics', 'aerodynamics', 'space systems', 'ship design', 'naval architecture', 'mineral processing',
//                     'reservoir engineering', 'process engineering', 'surveying', 'mapping', 'digital systems', 'embedded systems', 'sustainable design', 'water resources', 'finite element analysis',
//                 ],
//                 'courses' => [
//                     'Associate in Architectural Technology' => ['aat', 'architectural drafting', 'autocad', 'blueprint reading'],
//                     'Associate in Civil Engineering Technology' => ['acet', 'civil engineering technology', 'surveying', 'project estimation'],
//                     'Associate in Mechanical Engineering Technology' => ['amet', 'mechanical engineering technology', 'hvac design', 'fluid mechanics'],
//                     'Associate in Electrical Engineering Technology' => ['aeet', 'electrical systems', 'electrical engineering technology'],
//                     'Associate in Electronics Engineering Technology' => ['aleet', 'electronics engineering', 'digital systems', 'embedded systems'],
//                     'Diploma in Geodetic Engineering Technology' => ['dget', 'surveying', 'mapping', 'geodetic surveying'],
//                     'Diploma in Mechatronics Engineering Technology' => ['dmet', 'mechatronics', 'robotics', 'automation'],
//                     'Certificate in Construction Management Technology' => ['construction management', 'site inspection', 'project estimation'],
//                 ]
//             ],
//             'Associate Agriculture, Forestry & Fisheries' => [
//                 'educ_level' => 'associate',
//                 'code' => 'AAGR',
//                 'skills' => [
//                     'crop cultivation', 'pest management', 'aquaculture setups', 'livestock breeding', 'organic farming', 'farm machinery operation',
//                     'soil science', 'agronomy', 'horticulture', 'forestry management', 'fisheries management', 'agricultural economics',
//                     'agricultural biotechnology', 'plant pathology', 'animal husbandry', 'agricultural engineering', 'agricultural extension', 'agroforestry', 'sustainable agriculture',
//                     'agricultural policy', 'food security', 'agricultural marketing', 'precision agriculture', 'agricultural research', 'agricultural education', 'agricultural finance',
//                     'aquaponics', 'hydroponics', 'greenhouse management', 'irrigation systems', 'soil fertility management', 'crop rotation planning', 'livestock nutrition', 'disease control in livestock',
//                     'fisheries biology', 'fish breeding techniques', 'forest ecology', 'timber harvesting', 'wildlife conservation', 'agroecology', 'climate-smart agriculture', 'agricultural data analysis',
//                     'remote sensing in agriculture', 'geospatial analysis for agriculture', 'agricultural policy analysis', 'agricultural supply chain management', 'agricultural product processing', 'food safety management',
//                     'agricultural entrepreneurship', 'rural development', 'agricultural innovation', 'agricultural sustainability', 'agricultural risk management',
//                 ],
//                 'courses' => [
//                     'Associate in Agricultural Technology' => ['aat', 'agri tech', 'crop cultivation', 'farm machinery operation'],
//                     'Diploma in Agriculture' => ['diploma agriculture', 'organic farming', 'agronomy'],
//                     'Associate in Fisheries Technology' => ['aft', 'fisheries technology', 'aquaculture setups', 'fish breeding techniques'],
//                     'Diploma in Forestry Technology' => ['dft', 'forestry technology', 'timber harvesting', 'forest ecology'],
//                     'Associate of Science in Agroforestry' => ['asaf', 'agroforestry course', 'sustainable agriculture'],
//                     'Diploma in Agricultural Entrepreneurship' => ['agripreneur', 'agricultural marketing', 'agricultural supply chain management'],
//                     'Certificate in Organic Agriculture Production' => ['organic agriculture', 'pest management', 'soil fertility management'],
//                     'Certificate in Aquaculture and Hatchery Operations' => ['aquaponics', 'hydroponics', 'hatchery operations'],
//                 ]
//             ],
//             'Associate Tourism, Hospitality & Culinary Arts' => [
//                 'educ_level' => 'associate',
//                 'code' => 'ATOUR',
//                 'skills' => [
//                     'tourism management', 'hospitality operations', 'culinary arts', 'event planning', 'travel agency operations', 'hotel management', 'restaurant management',
//                     'tour guiding', 'customer service', 'sales and marketing', 'human resources', 'financial management', 'strategic planning', 'quality assurance',
//                     'food and beverage service', 'front office operations', 'housekeeping management', 'revenue management', 'hospitality law and ethics',
//                     'culinary techniques', 'menu planning', 'food safety and sanitation', 'nutrition and dietetics', 'pastry and baking', 'beverage management', 'culinary innovation',
//                     'culinary entrepreneurship', 'culinary presentation and plating', 'culinary event management', 'culinary nutrition', 'culinary sustainability', 'culinary research and development',
//                     'culinary technology', 'culinary business management', 'culinary marketing', 'culinary operations management', 'culinary leadership', 'culinary team management',
//                     'culinary cost control', 'culinary menu engineering', 'culinary food styling', 'culinary sensory evaluation', 'culinary international cuisine', 'culinary cultural gastronomy',
//                     'culinary food trends', 'culinary food photography', 'culinary food writing', 'culinary food science', 'culinary food innovation', 'culinary food entrepreneurship',
//                 ],
//                 'courses' => [
//                     'Associate in Tourism Management' => ['atm', 'associate tourism', 'travel agency operations', 'tour guiding'],
//                     'Associate in Hospitality Management' => ['ahm', 'associate hospitality', 'hotel management', 'front office operations'],
//                     'Associate in Hotel and Restaurant Management' => ['ahrm', 'hrm', 'housekeeping management', 'food and beverage service'],
//                     'Diploma in Culinary Arts' => ['diploma culinary', 'culinary techniques', 'menu planning'],
//                     'Associate in Commercial Cookery' => ['commercial cookery', 'culinary operations management', 'culinary cost control'],
//                     'Diploma in Baking and Pastry Arts' => ['pastry and baking', 'baking arts', 'baking diploma'],
//                     'Certificate in Tour Guiding Services' => ['tour guiding', 'travel services', 'guiding certificate'],
//                     'Certificate in Food and Beverage Services' => ['f&b service', 'food beverage service', 'beverage management'],
//                 ]
//             ],
//             'Associate Arts, Design & Media' => [
//                 'educ_level' => 'associate',
//                 'code' => 'AARTS',
//                 'skills' => [
//                     'graphic design', 'multimedia arts', 'animation', 'digital illustration', 'photography', 'videography',
//                     'video editing', 'audio production', 'sound design', 'visual effects', 'motion graphics', 'ui/ux design',
//                     'fine arts', 'painting', 'sculpture', 'drawing', 'art direction', 'creative writing',
//                     'advertising design', 'interior design', 'fashion design', 'textile design', 'industrial design',
//                     'calligraphy', 'typography', 'branding and identity', 'digital marketing', 'social media content creation',
//                     'copywriting', 'scriptwriting', 'storyboarding', 'cinematography', 'broadcast journalism', 'mass communication',
//                     'public relations', 'event styling', '3d modeling', 'texture mapping', 'game art design', 'web design'
//                 ],
//                 'courses' => [
//                     'Associate in Arts' => ['aa', 'associate arts', 'liberal arts'],
//                     'Associate in Multimedia Arts' => ['ama', 'multimedia arts', 'digital content creation'],
//                     'Associate in Graphic Design' => ['agd', 'graphic design', 'digital illustration', 'typography'],
//                     'Diploma in Animation' => ['diploma animation', '2d animation', '3d modeling', 'storyboarding'],
//                     'Diploma in Fine Arts' => ['dfa', 'fine arts diploma', 'painting', 'drawing'],
//                     'Associate in Interior Design' => ['aid', 'interior design', 'space planning', 'event styling'],
//                     'Diploma in Fashion Design and Technology' => ['dfdt', 'fashion design', 'textile design'],
//                     'Certificate in Digital Filmmaking' => ['digital filmmaking', 'videography', 'video editing', 'cinematography'],
//                 ]
//             ],
//             'Associate Social Sciences & Community Services' => [
//                 'educ_level' => 'associate',
//                 'code' => 'ASOC',
//                 'skills' => [
//                     'case management', 'community organizing', 'counseling', 'emergency response', 'risk assessment', 'public safety management',
//                     'social work', 'psychology', 'sociology', 'anthropology', 'political science', 'economics', 'public administration',
//                     'social policy analysis', 'community development', 'human services', 'crisis intervention',
//                     'advocacy', 'cultural competency', 'conflict resolution', 'program evaluation', 'grant writing', 'nonprofit management', 'volunteer coordination',
//                     'social research methods', 'data collection and analysis', 'community needs assessment', 'social justice initiatives', 'policy advocacy',
//                     'community engagement strategies', 'mental health support', 'substance abuse counseling', 'family therapy', 'child welfare services',
//                     'elder care management', 'disaster preparedness and response', 'public health education', 'youth development programs', 'gender studies',
//                     'human rights advocacy', 'international development', 'social entrepreneurship', 'community-based participatory research',
//                     'cultural preservation', 'social impact assessment', 'community resilience planning', 'social innovation', 'cross-cultural communication',
//                     'community health promotion', 'social work ethics and standards', 'community-based interventions', 'social policy implementation', 'community capacity building'
//                 ],
//                 'courses' => [
//                     'Associate in Criminology' => ['acrim', 'criminology', 'criminal justice', 'public safety management'],
//                     'Associate in Human Services' => ['ahs', 'human services', 'community support', 'social welfare'],
//                     'Associate of Arts in Psychology' => ['aapsych', 'psychology', 'behavioral science', 'mental health support'],
//                     'Associate in Community Development' => ['acd', 'community development', 'community organizing', 'social planning'],
//                     'Diploma in Social Work Technology' => ['dswt', 'social work', 'case management', 'child welfare services'],
//                     'Diploma in Disaster Risk Management' => ['ddrm', 'disaster management', 'emergency response', 'disaster preparedness and response'],
//                     'Certificate in Community Health Work' => ['cchw', 'community health', 'health promotion', 'public health education'],
//                     'Certificate in Substance Abuse Counseling' => ['csac', 'substance abuse counseling', 'crisis intervention', 'counseling'],
//                 ]
//             ],
//             'Associate Industrial, Manufacturing & Trades' => [
//                 'educ_level' => 'associate',
//                 'code' => 'ATRADE',
//                 'skills' => [
//                     'welding', 'machining', 'fabrication', 'preventive maintenance', 'industrial technology', 'automotive servicing', 'electrical house wiring',
//                     'refrigeration servicing', 'carpentry', 'masonry', 'concrete work', 'HVAC repair and maintenance', 'lathe machine operation',
//                     'industrial safety', 'quality control', 'production planning', 'lean manufacturing', 'automation systems', 'robotics operation',
//                     'industrial equipment troubleshooting', 'hydraulic and pneumatic systems', 'industrial instrumentation', 'process control', 'material handling',
//                     'industrial maintenance', 'welding techniques', 'metal fabrication', 'assembly line operations', 'industrial project management',
//                     'industrial design', 'industrial engineering', 'manufacturing processes', 'industrial automation', 'industrial robotics', 'industrial electronics',
//                     'industrial computer systems', 'industrial networking', 'industrial software applications', 'industrial data analysis', 'industrial process optimization',
//                     'industrial energy management', 'industrial environmental compliance', 'industrial quality assurance', 'industrial supply chain management',
//                 ],
//                 'courses' => [
//                     'Associate in Industrial Technology' => ['asit', 'industrial technology', 'preventive maintenance'],
//                     'Diploma in Automotive Technology' => ['dat', 'automotive servicing', 'engine troubleshooting'],
//                     'Diploma in Electrical Engineering Technology' => ['deet', 'electrical house wiring', 'electrical systems'],
//                     'Diploma in Mechanical Technology' => ['dmt', 'machining and fabrication', 'lathe machine operation'],
//                     'Certificate in Welding Technology' => ['cwt', 'welding', 'fabrication'],
//                     'Certificate in Refrigeration and Air Conditioning' => ['rac', 'HVAC repair and maintenance', 'refrigeration servicing'],
//                     'Certificate in Building Construction Technology' => ['cbct', 'carpentry', 'masonry and concrete work'],
//                 ]
//             ],

//             'Associate Logistics, Supply Chain & Transportation' => [
//                 'educ_level' => 'associate',
//                 'code' => 'ALOG',
//                 'skills' => [
//                     'fleet management', 'route optimization', 'inventory control', 'warehouse operations', 'defensive driving', 'forklift operation', 'freight forwarding',
//                     'customs clearance', 'logistics planning', 'supply chain analysis', 'transportation safety', 'shipping documentation', 'cargo handling',
//                     'distribution management', 'logistics software proficiency', 'transportation regulations', 'supply chain strategy', 'demand forecasting',
//                     'transportation cost analysis', 'logistics network design', 'supply chain risk management', 'transportation scheduling', 'logistics performance metrics',
//                     'supply chain sustainability', 'transportation compliance', 'logistics project management', 'supply chain collaboration', 'transportation technology integration',
//                     'logistics process improvement', 'supply chain analytics', 'transportation capacity planning', 'logistics vendor management',
//                     'supply chain visibility', 'transportation route planning', 'logistics cost optimization', 'supply chain resilience', 'transportation fleet maintenance',
//                     'logistics customer service', 'supply chain inventory optimization', 'transportation safety protocols', 'logistics risk assessment', 'supply chain performance measurement',
//                     'transportation regulatory compliance', 'logistics data analysis', 'supply chain process mapping', 'transportation demand management', 'logistics continuous improvement',
//                     'supply chain technology adoption', 'transportation sustainability practices',
//                 ],
//                 'courses' => [
//                     'Associate in Supply Chain Management' => ['ascm', 'logistics associate', 'inventory control'],
//                     'Associate in Customs Administration' => ['aca', 'customs clearance', 'shipping documentation'],
//                     'Diploma in Logistics and Transport Management' => ['dltm', 'fleet management', 'warehouse operations'],
//                     'Certificate in Warehouse and Distribution Operations' => ['cwdo', 'cargo handling', 'forklift operation'],
//                 ]
//             ],

//             'Associate Customer Service & Business Process Outsourcing' => [
//                 'educ_level' => 'associate',
//                 'code' => 'BPO',
//                 'skills' => [
//                     'inbound calling', 'outbound sales', 'technical support', 'chat support', 'escalation handling', 'bilingual communication', 'CRM data entry',
//                     'customer relationship management', 'call center operations', 'virtual assistance', 'billing and collection', 'office productivity software',
//                 ],
//                 'courses' => [
//                     'Associate in Contact Center Management' => ['accm', 'call center operations', 'inbound calling'],
//                     'Diploma in Business Process Outsourcing' => ['dbpo', 'customer service', 'technical support'],
//                     'Certificate in Virtual Assistance and Customer Support' => ['cva', 'virtual assistance', 'chat support'],
//                 ]
//             ],

//             'Associate Maritime & Seafaring' => [
//                 'educ_level' => 'associate',
//                 'code' => 'AMAR',
//                 'skills' => [
//                     'navigation', 'ship handling', 'maritime safety', 'seamanship', 'marine engineering', 'cargo operations', 'maritime law',
//                     'ship maintenance', 'maritime communication', 'port operations', 'maritime logistics',
//                     'ship stability', 'marine propulsion systems', 'maritime meteorology', 'shipboard firefighting', 'maritime security', 'shipboard emergency response', 'maritime environmental protection',
//                     'shipboard navigation systems', 'maritime regulations and compliance', 'shipboard maintenance procedures', 'maritime operations management', 'shipboard safety protocols',
//                     'maritime communication systems', 'shipboard cargo handling', 'maritime risk assessment', 'shipboard emergency drills', 'maritime search and rescue operations',
//                     'shipboard navigation techniques', 'maritime vessel inspection', 'shipboard maintenance planning', 'maritime safety management systems', 'shipboard emergency response planning', 'maritime environmental regulations',
//                     'shipboard navigation charts', 'maritime communication protocols', 'shipboard cargo securing', 'maritime accident investigation', 'shipboard emergency medical response',
//                     'maritime navigation aids', 'shipboard maintenance documentation', 'maritime safety training', 'shipboard emergency evacuation procedures', 'maritime environmental impact assessment',
//                     'shipboard navigation equipment', 'maritime communication procedures', 'shipboard cargo documentation', 'maritime safety audits', 'shipboard emergency response drills',
//                     'maritime environmental compliance', 'shipboard navigation planning', 'maritime communication systems operation', 'shipboard cargo handling techniques', 'maritime safety regulations',
//                     'shipboard emergency response coordination', 'maritime environmental protection measures', 'shipboard navigation systems troubleshooting', 'maritime communication equipment maintenance',
//                     'shipboard cargo stowage planning', 'maritime safety management practices', 'shipboard emergency response training', 'maritime environmental conservation strategies',
//                 ],
//                 'courses' => [
//                     'Associate in Marine Transportation' => ['amt', 'pre-deck officer', 'seamanship', 'navigation'],
//                     'Associate in Marine Engineering' => ['ame', 'pre-engine officer', 'marine propulsion systems'],
//                     'Diploma in Maritime Studies' => ['dms', 'maritime operations', 'ship maintenance'],
//                 ]
//             ],


//             'Technology & IT' => [
//                 'educ_level' => 'bachelor',
//                 'code' => 'TECH',
//                 'skills' => [
//                     'information technology', 'computer science', 'information systems',
//                     'cybersecurity', 'data science', 'programming', 'software development', 'web developer',
//                     'network administrator', 'full-stack development', 'mobile application development',
//                     'cloud computing', 'database management', 'machine learning', 'artificial intelligence',
//                     'ui/ux design', 'network security', 'devops', 'software engineering', 'data analytics',
//                     'game development', 'system administration', 'it support', 'natural language processing', 'deep learning', 'cloud architecture', 'blockchain development',
//                     'smart contract programming', 'it governance', 'enterprise architecture', 'information audit',
//                     'digital forensics', 'ethical hacking', 'penetration testing', 'embedded systems',
//                     'robotics processing automation', 'internet of things', 'computer systems servicing',
//                     'hardware troubleshooting', 'digital curation', 'metadata management', 'database administration'
//                 ],
//                 'courses' => [
//                     'Bachelor of Science in Information Technology' => ['bsit', 'information technology'],
//                     'Bachelor of Science in Computer Science' => ['bscs', 'computer science'],
//                     'Bachelor of Science in Information Systems' => ['bsis', 'information systems'],
//                     'Bachelor of Science in Entertainment and Multimedia Computing' => ['bsemc', 'multimedia arts', 'animation', 'game development'],
//                     'Bachelor of Science in Cybersecurity' => ['bsc', 'cybersecurity', 'information security'],
//                     'Bachelor of Science in Data Science' => ['bsds', 'data science', 'data analytics'],
//                     'Bachelor of Science in Software Engineering' => ['bssofteng', 'software engineering'],
//                     'Bachelor of Science in Artificial Intelligence' => ['bsai', 'artificial intelligence', 'machine learning'],
//                     'Bachelor of Science in Library and Information Science' => ['bslis', 'information management', 'digital curation', 'metadata management'],
//                     'Bachelor of Science in Technology Management' => ['bstechman', 'it governance', 'tech management', 'project management'],
//                     'Bachelor of Science in Blockchain Technology' => ['bsbt', 'blockchain development', 'smart contracts', 'cryptography']
//                 ]
//             ],
//             'Finance & Legal' => [
//                 'educ_level' => 'bachelor',
//                 'code' => 'FIN',
//                 'skills' => ['accounting', 'accountancy', 'auditing', 'finance', 'banking', 'legal management', 'lawyer', 'cpa',
//                             'financial analysis', 'taxation', 'bookkeeping', 'management accounting', 'forensic accounting',
//                             'budgeting', 'cost accounting', 'financial forecasting', 'risk management', 'investment banking',
//                             'portfolio management', 'wealth management', 'credit analysis', 'actuarial valuation',
//                             'treasury management', 'payroll processing', 'public fiscal administration', 'revenue auditing',
//                             'legal research', 'legal drafting', 'litigation support', 'contract management', 'corporate compliance',
//                             'labor relations', 'regulatory affairs', 'paralegal services', 'alternative dispute resolution',
//                             'intellectual property protection', 'court stenography', 'judicial administration', 'notarial services',
//                             'tax law advisory', 'customs brokerage', 'commercial arbitration', 'legislative drafting'],
//                 'courses' => [
//                     'Bachelor of Science in Accountancy' => ['bsa', 'accounting', 'accountancy', 'auditing', 'cpa'],
//                     'Bachelor of Science in Legal Management' => ['bslm', 'legal management', 'lawyer-'],
//                     'Juris Doctor' => ['jd', 'law', 'lawyer', 'litigation', 'bar exam'],
//                     'Bachelor of Science in Management Accounting' => ['bsma', 'management accounting', 'cost accounting', 'financial analysis'],
//                     'Bachelor of Science in Internal Auditing' => ['bsia', 'internal audit', 'risk assessment', 'compliance'],
//                     'Bachelor of Science in Accounting Information Systems' => ['bsais', 'accounting systems', 'bookkeeping', 'it audit'],
//                     'Bachelor of Science in Business Administration major in Financial Management' => ['bsba fm', 'financial management', 'banking', 'investments'],

//                     'Bachelor of Science in Public Administration' => ['bspa', 'public fiscal administration', 'government budgeting', 'public policy'],
//                     'Bachelor of Arts in Political Science' => ['baps', 'pre-law', 'legal research', 'political analysis'],
//                     'Bachelor of Science in Economics' => ['bsecon', 'econometrics', 'financial forecasting', 'economic analysis'],
//                     'Bachelor of Science in Actuarial Science' => ['bsas', 'risk calculation', 'insurance math', 'actuarial valuation'],
//                     'Bachelor of Arts in Legal Studies' => ['bals', 'paralegal studies', 'legal theory', 'jurisprudence'],
//                     'Bachelor of Science in International Studies major in International Law' => ['bsis il', 'international law', 'diplomacy', 'foreign policy'],
//                     'Diploma in Financial Technology' => ['fintech', 'digital banking', 'financial data analytics']
//                 ]
//             ],
//             'Business & Administration' => [
//                 'educ_level' => 'bachelor',
//                 'code' => 'BUS',
//                 'skills' => ['business administration', 'hospitality management', 'public administration', 'entrepreneurship', 'management studies', 'office administration',
//                             'human resources', 'marketing', 'sales', 'operations management', 'strategic planning', 'business analytics',
//                             'supply chain management', 'project management', 'financial management', 'organizational behavior',
//                             'business communication', 'leadership development', 'customer relationship management',
//                             'business law and ethics', 'international business', 'e-commerce management', 'retail management',
//                             'event planning and management', 'business intelligence', 'corporate governance', 'risk assessment',
//                             'performance management', 'change management', 'project management', 'operations management', 'strategic planning', 'business development',
//                             'change management', 'supply chain management', 'logistics planning', 'procurement',
//                             'inventory management', 'franchise management', 'risk assessment', 'corporate governance',
//                             'digital marketing', 'social media management', 'search engine optimization', 'sales management',
//                             'market research', 'brand management', 'public relations', 'customer relationship management',
//                             'e-commerce management', 'b2b sales', 'content marketing', 'advertising strategy',
//                             'human resource management', 'talent acquisition', 'employee relations', 'payroll administration',
//                             'performance management', 'training and development', 'organizational development', 'labor compliance',
//                             'executive assistance', 'records management', 'data entry', 'business correspondence',
//                             'front office operations', 'event planning', 'customer service excellence', 'transcription',
//                             'call center operations', 'virtual assistance', 'billing and collection', 'office productivity software'],
//                 'courses' => [
//                     'Bachelor of Science in Business Administration' => ['bsba', 'business administration', 'management studies'],
//                     'Bachelor of Science in Business Administration major in Marketing Management' => ['bsba mm', 'marketing management', 'digital marketing', 'sales'],
//                     'Bachelor of Science in Business Administration major in Human Resource Management' => ['bsba hrm', 'human resource management', 'talent acquisition', 'personnel admin'],
//                     'Bachelor of Science in Business Administration major in Operations Management' => ['bsba om', 'operations management', 'quality control'],
//                     'Bachelor of Science in Entrepreneurship' => ['bsentrep', 'entrepreneurship', 'business start-up', 'franchising'],
//                     'Bachelor of Science in Office Administration' => ['bsoa', 'office administration', 'secretarial procedures', 'clerical support'],
//                     'Bachelor of Science in Real Estate Management' => ['bsrem', 'real estate brokerage', 'property management', 'appraisal'],
//                     'Bachelor of Science in Business Analytics' => ['bsba analytics', 'business intelligence', 'data-driven marketing', 'data analysis'],
//                 ]
//             ],
//             'Education & Training' => [
//                 'educ_level' => 'bachelor',
//                 'code' => 'EDUC',
//                 'skills' => ['elementary education', 'secondary education', 'early childhood', 'physical education', 'special needs education', 'teacher', 'instructional design',
//                             'curriculum development', 'educational technology', 'classroom management', 'assessment and evaluation',
//                             'pedagogy', 'learning theories', 'educational psychology', 'literacy development', 'numeracy skills',
//                             'language acquisition', 'multicultural education', 'inclusive education', 'educational leadership',
//                             'professional development', 'mentoring and coaching', 'educational research', 'instructional strategies',
//                             'educational policy', 'school administration', 'student engagement', 'educational assessment tools',
//                             'special education strategies', 'behavior management techniques', 'differentiated instruction',
//                             'educational software proficiency', 'online teaching methodologies', 'blended learning approaches',
//                             'classroom technology integration', 'lesson planning and design', 'student-centered learning approaches',
//                             'formative and summative assessment techniques'],
//                 'courses' => [
//                     'Bachelor of Elementary Education' => ['beed', 'elementary education'],
//                     'Bachelor of Secondary Education' => ['bsed', 'secondary education'],
//                     'Bachelor of Early Childhood Education' => ['bece', 'early childhood education'],
//                     'Bachelor of Physical Education' => ['bpe', 'physical education'],
//                     'Bachelor of Special Needs Education' => ['bsne', 'special needs education'],
//                     'Bachelor of Science in Educational Technology' => ['bset', 'educational technology', 'instructional design'],
//                     'Bachelor of Science in Educational Leadership' => ['bsel', 'educational leadership', 'school administration'],
//                     'Bachelor of Science in Curriculum and Instruction' => ['bsci', 'curriculum development', 'instructional strategies'],
//                     'Bachelor of Science in Educational Psychology' => ['bsep', 'educational psychology', 'learning theories'],
//                     'Bachelor of Science in Literacy and Numeracy Education' => ['bsln', 'literacy development', 'numeracy skills'],
//                     'Bachelor of Science in Multicultural Education' => ['bsmeduc', 'multicultural education', 'inclusive education'],
//                     'Bachelor of Science in Special Education Strategies' => ['bsses', 'special education strategies', 'behavior management techniques'],
//                     'Bachelor of Science in Online Teaching Methodologies' => ['bsotm', 'online teaching methodologies', 'blended learning approaches'],
//                 ]
//             ],
//             'Healthcare & Life Sciences' => [
//                 'educ_level' => 'bachelor',
//                 'code' => 'HEAL',
//                 'skills' => ['nursing', 'medical laboratory', 'pharmaceutical', 'public health', 'midwifery', 'radiologic technology', 'biology', 'microbiology',
//                             'anatomy', 'physiology', 'biochemistry', 'genetics', 'immunology', 'pathology', 'pharmacology',
//                             'epidemiology', 'healthcare management', 'clinical research', 'medical ethics', 'patient care',
//                             'health informatics', 'biostatistics', 'toxicology', 'virology', 'parasitology',
//                             'molecular biology', 'cell biology', 'neuroscience', 'biophysics', 'bioinformatics',
//                             'environmental health', 'occupational health', 'nutrition science', 'gerontology',
//                             'rehabilitation sciences', 'health policy and administration', 'medical imaging', 'surgical technology', 'emergency medical services', 'phlebotomy', 'cardiovascular technology',
//                             'respiratory therapy', 'anesthesia technology', 'dental hygiene', 'optometry', 'speech-language pathology',
//                             'audiology', 'occupational therapy', 'physical therapy', 'veterinary technology', 'clinical laboratory science',
//                             'medical coding and billing', 'healthcare quality management', 'healthcare compliance', 'healthcare data analytics',
//                             'telemedicine', 'healthcare innovation', 'biomedical engineering', 'genomic medicine', 'personalized medicine', 'regenerative medicine',
//                             'stem cell research', 'nanomedicine', 'pharmacogenomics', 'healthcare entrepreneurship', 'medical device development',
//                             'healthcare policy analysis', 'global health initiatives', 'community health education', 'health'],
//                 'courses' => [
//                     'Bachelor of Science in Nursing' => ['bsn', 'nursing'],
//                     'Bachelor of Science in Medical Laboratory Science' => ['bsmls', 'medical laboratory', 'clinical laboratory'],
//                     'Bachelor of Science in Pharmacy' => ['bspharm', 'pharmaceutical', 'pharmacy'],
//                     'Bachelor of Science in Public Health' => ['bsph', 'public health'],
//                     'Bachelor of Science in Midwifery' => ['bsmid', 'midwifery', 'maternal health'],
//                     'Bachelor of Science in Radiologic Technology' => ['bsrt', 'radiologic technology', 'medical imaging'],
//                     'Bachelor of Science in Biology' => ['bsbio', 'biology', 'life sciences'],
//                     'Bachelor of Science in Microbiology' => ['bsmicro', 'microbiology', 'virology', 'parasitology'],
//                     'Bachelor of Science in Biochemistry' => ['bsbiochem', 'biochemistry', 'molecular biology', 'cell biology'],
//                     'Bachelor of Science in Genetics' => ['bsgene', 'genetics', 'genomics', 'personalized medicine'],
//                     'Bachelor of Science in Immunology' => ['bsimmuno', 'immunology', 'vaccine development', 'regenerative medicine'],
//                     'Bachelor of Science in Pathology' => ['bspath', 'pathology', 'disease mechanisms', 'clinical pathology'],
//                     'Bachelor of Science in Pharmacology' => ['bspharmaco', 'pharmacology', 'drug development', 'pharmacogenomics'],
//                     'Bachelor of Science in Epidemiology' => ['bsepi', 'epidemiology', 'public health research', 'disease surveillance'],
//                     'Bachelor of Science in Health Informatics' => ['bshi', 'health informatics', 'healthcare data analytics', 'telemedicine'],
//                     'Bachelor of Science in Biostatistics' => ['bsbio stats', 'biostatistics', 'health data analysis', 'clinical trials'],
//                     'Bachelor of Science in Toxicology' => ['bstox', 'toxicology', 'environmental health', 'occupational health'],
//                     'Bachelor of Science in Neuroscience' => ['bsneuro', 'neuroscience', 'brain research', 'cognitive science'],
//                     'Bachelor of Science in Biomedical Engineering' => ['bsbme', 'biomedical engineering', 'medical device development', 'healthcare innovation'],
//                 ]
//             ],
//             'Engineering & Architecture' => [
//                 'educ_level' => 'bachelor',
//                 'code' => 'ENG',
//                 'skills' => [
//                     'structural design', 'AutoCAD', 'blueprint reading', 'project estimation', 'site inspection', 'HVAC design',
//                     'plumbing systems', 'electrical systems', 'civil engineering', 'mechanical engineering', 'architectural design',
//                     'construction management', 'geotechnical engineering', 'transportation engineering', 'environmental engineering', 'industrial engineering', 'chemical engineering', 'aerospace engineering', 'marine engineering',
//                     'mining engineering', 'petroleum engineering', 'industrial design', 'landscape architecture',
//                     'structural engineering', 'transportation engineering', 'mechatronics engineering', 'geodetic engineering', 'electronics engineering', 'electrical engineering', 'materials science', 'robotics', 'automation', 'thermodynamics', 'fluid mechanics', 'aerodynamics', 'space systems', 'ship design', 'naval architecture', 'mineral processing',
//                     'reservoir engineering', 'process engineering', 'surveying', 'mapping', 'digital systems', 'embedded systems', 'sustainable design', 'water resources', 'finite element analysis',
//                     'industrial energy management', 'industrial environmental compliance', 'industrial quality assurance', 'industrial supply chain management'

//                 ],
//                 'courses' => [
//                     'Bachelor of Science in Civil Engineering' => ['bscivil', 'civil engineering', 'structural analysis', 'construction management-'],
//                     'Bachelor of Science in Mechanical Engineering' => ['bsme', 'mechanical engineering', 'thermodynamics', 'fluid mechanics'],
//                     'Bachelor of Science in Architecture' => ['bsarch', 'architecture', 'building design', 'urban planning'],
//                     'Bachelor of Science in Electrical Engineering' => ['bselectrical', 'electrical engineering', 'circuit analysis', 'power systems'],
//                     'Bachelor of Science in Electronics Engineering' => ['bselectronics', 'electronics engineering', 'embedded systems', 'telecommunications'],
//                     'Bachelor of Science in Environmental Engineering' => ['bsenvironment', 'environmental engineering', 'water resources', 'sustainable design'],
//                     'Bachelor of Science in Chemical Engineering' => ['bsche', 'chemical engineering', 'process engineering', 'materials science'],
//                     'Bachelor of Science in Geodetic Engineering' => ['bsge', 'geodetic engineering', 'surveying', 'mapping'],
//                     'Bachelor of Science in Computer Engineering' => ['bscomeng', 'computer engineering', 'digital systems', 'embedded systems-'],
//                     'Bachelor of Science in Mechatronics Engineering' => ['bsmech', 'mechatronics engineering', 'robotics', 'automation'],
//                     'Bachelor of Science in Aerospace Engineering' => ['bsae', 'aerospace engineering', 'aerodynamics', 'space systems'],
//                     'Bachelor of Science in Mining Engineering' => ['bsmin', 'mining engineering', 'mineral processing', 'geotechnical engineering'],
//                     'Bachelor of Science in Petroleum Engineering' => ['bspe', 'petroleum engineering', 'reservoir engineering', 'drilling'],
//                     'Bachelor of Science in Industrial Design' => ['bsid', 'industrial design', 'product design', 'ergonomics'],
//                     'Bachelor of Science in Landscape Architecture' => ['bsla', 'landscape architecture', 'urban design', 'environmental planning'],
//                     'Bachelor of Science in Construction Management' => ['bscm', 'construction management', 'project scheduling', 'cost estimation'],
//                     'Bachelor of Science in Structural Engineering' => ['bsstruceng', 'structural engineering', 'finite element analysis', 'earthquake engineering'],
//                     'Bachelor of Science in Transportation Engineering' => ['bste', 'transportation engineering', 'traffic analysis', 'highway design'],
//                 ]
//             ],
//             'Agriculture, Forestry & Fisheries' => [
//                 'educ_level' => 'bachelor',
//                 'code' => 'AGR',
//                 'skills' => [
//                     'crop cultivation', 'pest management', 'aquaculture setups', 'livestock breeding', 'organic farming', 'farm machinery operation',
//                     'soil science', 'agronomy', 'horticulture', 'forestry management', 'fisheries management', 'agricultural economics',
//                     'agricultural biotechnology', 'plant pathology', 'animal husbandry', 'agricultural engineering', 'agricultural extension', 'agroforestry', 'sustainable agriculture',
//                     'agricultural policy', 'food security', 'agricultural marketing', 'precision agriculture', 'agricultural research', 'agricultural education', 'agricultural finance',
//                     'aquaponics', 'hydroponics', 'greenhouse management', 'irrigation systems', 'soil fertility management', 'crop rotation planning', 'livestock nutrition', 'disease control in livestock',
//                     'fisheries biology', 'fish breeding techniques', 'forest ecology', 'timber harvesting', 'wildlife conservation', 'agroecology', 'climate-smart agriculture', 'agricultural data analysis',
//                     'remote sensing in agriculture', 'geospatial analysis for agriculture', 'agricultural policy analysis', 'agricultural supply chain management', 'agricultural product processing', 'food safety management',
//                     'agricultural entrepreneurship', 'rural development', 'agricultural innovation', 'agricultural sustainability', 'agricultural risk management',
//                 ],
//                 'courses' => [
//                     'Bachelor of Science in Agriculture' => ['bsagri', 'agriculture'],
//                     'Bachelor of Science in Fisheries' => ['bsfish', 'fisheries'],
//                     'Bachelor of Science in Forestry' => ['bsforest', 'forestry'],
//                 ]
//             ],
//             'Tourism, Hospitality & Culinary Arts' => [
//                 'educ_level' => 'bachelor',
//                 'code' => 'TOUR',
//                 'skills' => [
//                     'tourism management', 'hospitality operations', 'culinary arts', 'event planning', 'travel agency operations', 'hotel management', 'restaurant management',
//                     'tour guiding', 'customer service', 'sales and marketing', 'human resources', 'financial management', 'strategic planning', 'quality assurance',
//                     'food and beverage service', 'front office operations', 'housekeeping management', 'revenue management', 'hospitality law and ethics',
//                     'culinary techniques', 'menu planning', 'food safety and sanitation', 'nutrition and dietetics', 'pastry and baking', 'beverage management', 'culinary innovation',
//                     'culinary entrepreneurship', 'culinary presentation and plating', 'culinary event management', 'culinary nutrition', 'culinary sustainability', 'culinary research and development',
//                     'culinary technology', 'culinary business management', 'culinary marketing', 'culinary operations management', 'culinary leadership', 'culinary team management',
//                     'culinary cost control', 'culinary menu engineering', 'culinary food styling', 'culinary sensory evaluation', 'culinary international cuisine', 'culinary cultural gastronomy',
//                     'culinary food trends', 'culinary food photography', 'culinary food writing', 'culinary food science', 'culinary food innovation', 'culinary food entrepreneurship',
//                 ],
//                 'courses' => [
//                     'Bachelor of Science in Tourism Management' => ['bstour', 'tourism'],
//                     'Bachelor of Science in Hospitality Management' => ['bshosp', 'hospitality'],
//                     'Bachelor of Science in Culinary Arts' => ['bsculinary', 'culinary'],
//                 ]
//             ],
//             'Arts, Design & Media' => [
//                 'educ_level' => 'bachelor',
//                 'code' => 'ARTS',
//                 'skills' => [
//                     'creative writing & storytelling', 'copywriting & content creation', 'news reporting & investigative journalism',
//                     'media ethics & communication theory', 'scriptwriting & storyboarding', 'video editing & post-production',
//                     'cinematography & film production', 'digital photography & photo editing', '2d & 3d animation',
//                     'game design & asset creation', 'graphic design & typography', 'visual communication & branding',
//                     'multimedia design & interactive media', 'advertising & creative strategy', 'fine arts composition & illustration',
//   'color theory & art history',
//   'interior architecture & space planning',
//   'fashion design & textile selection',
//   'garment construction & pattern making',
//   'music composition & music theory',
//   'audio engineering & sound design',
//   'theatrical performance & acting',
//   'stage design & production management',
//   'choreography & dance technique',
//   'creative direction',
//   'adobe creative suite (photoshop, illustrator, premiere)',
//   '3d modeling & rendering (blender, maya, autocad)',
//   'digital audio workstations (pro tools, logic pro)',
//   'game engines (unity, unreal engine)',
//   'content management systems (cms)',
//   'social media strategy',
//   'public relations & public speaking',
//   'portfolio curation',
//   'collaborative production workflow'
//                 ],
//                 'courses' => [
//                     'Bachelor of Fine Arts' => ['bfa', 'fine arts', 'painting', 'sculpture', 'drawing'],
//                     'Bachelor of Science in Communication' => ['bcomm', 'communication'],
//                     'Bachelor of Arts in Journalism' => ['baj', 'journalism', 'reporting', 'editing'],
//                     'Bachelor of Arts in Multimedia Arts' => ['bama', 'multimedia arts-', 'animation-', 'graphic design', 'video production'],
//                     'Bachelor of Arts in Film and Television Production' => ['baftp', 'film production', 'television production', 'cinematography'],
//                     'Bachelor of Arts in Music' => ['bam', 'music', 'composition', 'performance'],
//                     'Bachelor of Arts in Theatre Arts' => ['bata', 'theatre arts', 'acting', 'stage production'],
//                     'Bachelor of Arts in Dance' => ['bad', 'dance', 'choreography', 'performance-'],
//                     'Bachelor of Arts in Fashion Design' => ['bafd', 'fashion design', 'textile design', 'garment construction'],
//                     'Bachelor of Arts in Interior Design' => ['baid', 'interior design', 'space planning', 'furniture design'],
//                     'Bachelor of Arts in Visual Communication' => ['bavc', 'visual communication', 'graphic design-', 'branding'],
//                     'Bachelor of Arts in Photography' => ['baph', 'photography', 'photojournalism', 'digital imaging'],
//                     'Bachelor of Arts in Animation' => ['baan', 'animation--', '3d modeling', 'motion graphics'],
//                     'Bachelor of Arts in Game Design' => ['bagd', 'game design', 'game development-', 'interactive media'],
//                     'Bachelor of Arts in Creative Writing' => ['bacw', 'creative writing', 'fiction', 'poetry', 'screenwriting'],
//                     'Bachelor of Arts in Advertising' => ['baadv', 'advertising', 'marketing communication', 'branding-'],
//                 ]
//             ],
//             'Social Sciences & Community Services' => [
//                 'educ_level' => 'bachelor',
//                 'code' => 'SOC',
//                 'skills' => [
//                     'case management', 'community organizing', 'counseling', 'emergency response', 'risk assessment', 'public safety management',
//                     'social work', 'psychology', 'sociology', 'anthropology', 'political science', 'economics', 'public administration',
//                     'social policy analysis', 'community development', 'human services', 'crisis intervention',
//                     'advocacy', 'cultural competency', 'conflict resolution', 'program evaluation', 'grant writing', 'nonprofit management', 'volunteer coordination',
//                     'social research methods', 'data collection and analysis', 'community needs assessment', 'social justice initiatives', 'policy advocacy',
//                     'community engagement strategies', 'mental health support', 'substance abuse counseling', 'family therapy', 'child welfare services',
//                     'elder care management', 'disaster preparedness and response', 'public health education', 'youth development programs', 'gender studies',
//                     'human rights advocacy', 'international development', 'social entrepreneurship', 'community-based participatory research',
//                     'cultural preservation', 'social impact assessment', 'community resilience planning', 'social innovation', 'cross-cultural communication',
//                     'community health promotion', 'social work ethics and standards', 'community-based interventions', 'social policy implementation', 'community capacity building'
//                 ],
//                 'courses' => [
//                     'Bachelor of Science in Criminology' => ['bscrim', 'criminology', 'criminal justice', 'forensic science'],
//                     'Bachelor of Science in Social Work' => ['bssw', 'social work'],
//                     'Bachelor of Science in Environmental Science' => ['bsenv', 'environmental science', 'sustainability', 'conservation'],
//                     'Bachelor of Science in Psychology' => ['bspsych', 'psychology', 'behavioral science', 'mental health'],
//                     'Bachelor of Science in Political Science' => ['bspol', 'political science', 'government', 'public policy-'],
//                     'Bachelor of Science in Sociology' => ['bssoc', 'sociology', 'social research-', 'community development-'],
//                     'Bachelor of Science in Anthropology' => ['bsanth', 'anthropology', 'cultural studies-', 'archaeology'],
//                     'Bachelor of Science in International Relations' => ['bsir', 'international relations', 'diplomacy-', 'global affairs'],
//                     'Bachelor of Science in Human Services' => ['bshs', 'human services', 'community support', 'social welfare'],
//                     'Bachelor of Science in Community Development' => ['bscd', 'community development', 'social planning'],
//                     'Bachelor of Science in Disaster Management' => ['bsdm', 'disaster management', 'emergency response', 'risk assessment-'],
//                     'Bachelor of Science in Gender Studies' => ['bsgender', 'gender studies', 'women\'s studies', 'feminist theory'],
//                     'Bachelor of Science in International Development' => ['bsidev', 'international development', 'global poverty', 'sustainable development'],
//                     'Bachelor of Science in Social Policy' => ['bssp', 'social policy', 'policy analysis', 'program evaluation'],
//                     'Bachelor of Science in Community Health' => ['bsch', 'community health', 'public health-', 'health promotion'],
//                     'Bachelor of Science in Social Entrepreneurship' => ['bssocialent', 'social entrepreneurship', 'social innovation-', 'impact investing'],
//                     'Bachelor of Science in Cultural Studies' => ['bcs', 'cultural studies', 'media analysis', 'popular culture'],
//                     'Bachelor of Science in Social Research' => ['bssr', 'social research', 'data collection', 'qualitative analysis'],
//                     'Bachelor of Science in Community Engagement' => ['bsce', 'community engagement', 'public participation', 'stakeholder collaboration'],
//                     'Bachelor of Science in Social Innovation' => ['bssi', 'social innovation', 'design thinking', 'social impact'],
//                 ]
//             ],
//             'Industrial, Manufacturing & Trades' => [
//                 'educ_level' => 'bachelor',
//                 'code' => 'TRADE',
//                 'skills' => [
//                     'structural welding', 'electrical house wiring', 'engine troubleshooting', 'lathe machine operation', 'preventive maintenance',
//                     'automotive servicing', 'diesel engine tune-up', 'plumbing and pipefitting', 'carpentry and woodworking', 'masonry and concrete work',
//                     'tile setting and finishing', 'painting and decoration', 'hvac repair and maintenance',
//                     'refrigeration servicing', 'scaffolding and rigging', 'heavy equipment operation', 'automotive electrical repair', 'wheel alignment and balancing',
//                     'machining and fabrication', 'organic farming techniques', 'crop production management', 'animal husbandry practices', 'poultry management',
//                     'swine raising', 'aquaculture cultivation', 'hydroponics and aquaponics', 'pest management and control', 'agricultural machinery operation',
//                     'food processing and preservation', 'meat cutting and butchery', 'baking and pastry production',
//                     'graphic design and visual communication', 'video editing and production', 'photography and photojournalism', 'tailoring and dressmaking',
//                     'fashion design and merchandising', 'handicraft making and artisan skills', 'upholstery and furniture restoration', 'signage making and printing',
//                     'hairdressing and beauty care', 'barbering and grooming', 'massage therapy and wellness services', 'security services and surveillance',
//                     'cctv monitoring and installation', 'first aid application and emergency response',
//                 ],
//                 'courses' => [
//                     'Bachelor of Science in Industrial Technology' => ['bsitech', 'industrial technology', 'manufacturing processes', 'quality control-'],
//                     'Bachelor of Science in Industrial Engineering' => ['bsie', 'industrial engineering', 'operations research', 'process optimization'],
//                     'Bachelor of Science in Manufacturing Engineering' => ['bsmeng', 'manufacturing engineering', 'production systems', 'automation-'],
//                     'Bachelor of Science in Welding Technology' => ['bswt', 'welding technology', 'structural welding', 'fabrication'],
//                     'Bachelor of Science in Automotive Technology' => ['bsat', 'automotive technology', 'engine troubleshooting', 'vehicle diagnostics'],
//                     'Bachelor of Science in Plumbing and Pipefitting' => ['bspp', 'plumbing', 'pipefitting', 'water systems'],
//                     'Bachelor of Science in Carpentry and Woodworking' => ['bscw', 'carpentry', 'woodworking', 'furniture making'],
//                     'Bachelor of Science in Masonry and Concrete Work' => ['bsmcw', 'masonry', 'concrete work', 'construction techniques'],
//                     'Bachelor of Science in HVAC Technology' => ['bshvac', 'hvac repair', 'heating and cooling systems', 'ventilation'],

//                 ]
//             ],
//             'Logistics, Supply Chain & Transportation' => [
//                 'educ_level' => 'bachelor',
//                 'code' => 'LOG',
//                 'skills' => [
//                     'fleet management', 'route optimization', 'inventory control', 'warehouse operations', 'defensive driving', 'forklift operation', 'freight forwarding',
//                     'customs clearance', 'logistics planning', 'supply chain analysis', 'transportation safety', 'shipping documentation', 'cargo handling',
//                     'distribution management', 'logistics software proficiency', 'transportation regulations', 'supply chain strategy', 'demand forecasting',
//                     'transportation cost analysis', 'logistics network design', 'supply chain risk management', 'transportation scheduling', 'logistics performance metrics',
//                     'supply chain sustainability', 'transportation compliance', 'logistics project management', 'supply chain collaboration', 'transportation technology integration',
//                     'logistics process improvement', 'supply chain analytics', 'transportation capacity planning', 'logistics vendor management',
//                     'supply chain visibility', 'transportation route planning', 'logistics cost optimization', 'supply chain resilience', 'transportation fleet maintenance',
//                     'logistics customer service', 'supply chain inventory optimization', 'transportation safety protocols', 'logistics risk assessment', 'supply chain performance measurement',
//                     'transportation regulatory compliance', 'logistics data analysis', 'supply chain process mapping', 'transportation demand management', 'logistics continuous improvement',
//                     'supply chain technology adoption', 'transportation sustainability practices',
//                 ],
//                 'courses' => [
//                     'Bachelor of Science in Logistics and Supply Chain Management' => ['bslscm', 'logistics', 'supply chain', 'transportation management-'],
//                     'Bachelor of Science in Customs Administration' => ['bsca', 'industrial engineering-', 'operations research-', 'process optimization-'],
//                     'Bachelor of Science in Transportation Management' => ['bstm', 'transportation management', 'fleet management', 'route optimization'],
//                 ]
//             ],
//             'Customer Service & Business Process Outsourcing' => [
//                 'educ_level' => 'bachelor',
//                 'code' => 'BPO',
//                 'skills' => [
//                     'inbound calling', 'outbound sales', 'technical support', 'chat support', 'escalation handling', 'bilingual communication', 'CRM data entry',
//                     'customer relationship management', 'call center operations', 'virtual assistance', 'billing and collection', 'office productivity software',
//                 ],
//                 'courses' => [
//                     'Bachelor of Science in Customer Service and Business Process Outsourcing' => ['bsbpo', 'customer service', 'business process outsourcing', 'call center operations'],
//                 ]
//             ],
//             'Maritime & Seafaring' => [
//                 'educ_level' => 'bachelor',
//                 'code' => 'MAR',
//                 'skills' => [
//                     'navigation', 'ship handling', 'maritime safety', 'seamanship', 'marine engineering', 'cargo operations', 'maritime law',
//                     'ship maintenance', 'maritime communication', 'port operations', 'maritime logistics',
//                     'ship stability', 'marine propulsion systems', 'maritime meteorology', 'shipboard firefighting', 'maritime security', 'shipboard emergency response', 'maritime environmental protection',
//                     'shipboard navigation systems', 'maritime regulations and compliance', 'shipboard maintenance procedures', 'maritime operations management', 'shipboard safety protocols',
//                     'maritime communication systems', 'shipboard cargo handling', 'maritime risk assessment', 'shipboard emergency drills', 'maritime search and rescue operations',
//                     'shipboard navigation techniques', 'maritime vessel inspection', 'shipboard maintenance planning', 'maritime safety management systems', 'shipboard emergency response planning', 'maritime environmental regulations',
//                     'shipboard navigation charts', 'maritime communication protocols', 'shipboard cargo securing', 'maritime accident investigation', 'shipboard emergency medical response',
//                     'maritime navigation aids', 'shipboard maintenance documentation', 'maritime safety training', 'shipboard emergency evacuation procedures', 'maritime environmental impact assessment',
//                     'shipboard navigation equipment', 'maritime communication procedures', 'shipboard cargo documentation', 'maritime safety audits', 'shipboard emergency response drills',
//                     'maritime environmental compliance', 'shipboard navigation planning', 'maritime communication systems operation', 'shipboard cargo handling techniques', 'maritime safety regulations',
//                     'shipboard emergency response coordination', 'maritime environmental protection measures', 'shipboard navigation systems troubleshooting', 'maritime communication equipment maintenance',
//                     'shipboard cargo stowage planning', 'maritime safety management practices', 'shipboard emergency response training', 'maritime environmental conservation strategies',
//                 ],
//                 'courses' => [
//                     'Bachelor of Science in Maritime & Seafaring' => ['bsmar', 'maritime studies', 'seafaring', 'nautical science'],
//                     'Bachelor of Science in Marine Transportation' => ['bsmt', 'marine transportation', 'navigation', 'ship handling'],
//                     'Bachelor of Science in Marine Engineering' => ['bsmareng', 'marine engineering', 'ship propulsion systems', 'marine systems maintenance'],
//                 ]
//             ],
//             'Other / Unclassified' => [
//                 'educ_level' => '0',
//                 'code' => 'OTHER',
//                 'skills' => [
//                     'communication', 'problem solving', 'critical thinking', 'teamwork',
//                     'time management', 'leadership', 'adaptability', 'work ethic',
//                     'interpersonal skills', 'project management', 'attention to detail',
//                     'planning and organizing', 'decision making', 'customer service',
//                     'computer literacy', 'data entry', 'microsoft office', 'google workspace',
//                     'technical writing', 'research skills', 'digital communication',
//                     'electrical installation', 'house wiring', 'structural welding', 'smaw welding', 'gmaw welding',
//                     'plumbing', 'pipefitting', 'carpentry', 'masonry', 'tile setting', 'painting and decoration',
//                     'hvac repair', 'refrigeration servicing', 'scaffolding', 'heavy equipment operation',
//                     'automotive servicing', 'engine troubleshooting', 'motorcycle repair', 'brake system servicing',
//                     'wheel alignment', 'diesel engine tune-up', 'auto electrical repair', 'machining',
//                     'organic farming', 'crop production', 'animal production', 'poultry management', 'swine raising',
//                     'aquaculture cultivation', 'hydroponics', 'pest management', 'agricultural machinery operation',
//                     'food processing', 'meat cutting', 'baking and pastry production',
//                     'graphic design', 'video editing', 'photography', 'photojournalism', 'tailoring', 'dressmaking',
//                     'fashion design', 'handicraft making', 'upholstery', 'signage making',
//                     'hairdressing', 'beauty care', 'barbering', 'massage therapy', 'wellness services',
//                     'security services', 'cctv monitoring', 'first aid application', 'emergency response'
//                 ],
//                 'courses' => [] // Kept empty so dynamic user inputs populate this at runtime!
//             ],
//             'Master Arts, Design & Media' => [
//                 'educ_level' => 'masters',
//                 'code' => 'MADM',
//                 'skills' => [
//                     'Formulating advanced critical and theoretical frameworks for creative practices', 'Directing large-scale multimedia productions, design projects, and exhibitions', 'Conducting comprehensive visual culture, material culture, and design research',
//                     'Managing creative design studios, media production houses, and cultural agencies', 'Developing complex user experience (UX) architectures and interactive narratives', 'Applying advanced methodologies in digital media arts and spatial design paradigms',
//                     'Navigating intellectual property rights, copyright laws, and creative industry economics', 'Synthesizing historical, cultural, and political contexts into modern creative workflows'
//                 ],
//                 'courses' => [
//                     'Master of Fine Arts (MFA)' => ['mfa', 'master of fine arts', 'creative writing', 'studio arts', 'visual arts'],
//                     'Master of Arts in Media and Communication (MAMC)' => ['mamc', 'media studies', 'mass communication', 'digital journalism'],
//                     'Master of Design (MDes)' => ['mdes', 'master of design', 'interaction design', 'industrial design', 'ux design']
//                 ]
//             ],

//             'Master Healthcare & Life Sciences' => [
//                 'educ_level' => 'masters',
//                 'code' => 'MHLS',
//                 'skills' => [
//                     'Designing and executing clinical trials and biomedical laboratory experiments', 'Analyzing complex biostatistical data and epidemiological population trends', 'Formulating systemic public health policies and global health interventions',
//                     'Managing healthcare facilities, hospital operations, and medical clinical workflows', 'Applying advanced methodologies in molecular biology, genomics, and cellular mechanics', 'Evaluating clinical risk management protocols and medical quality assurance systems',
//                     'Navigating bioethical principles, medical jurisprudence, and healthcare regulations', 'Developing healthcare informatics architectures and digital patient tracking systems'
//                 ],
//                 'courses' => [
//                     'Master of Public Health (MPH)' => ['mph', 'master of public health', 'epidemiology', 'community health'],
//                     'Master of Science in Nursing (MSN)' => ['msn', 'master of science in nursing', 'nursing administration', 'clinical nurse leader'],
//                     'Master of Science in Biomedical Science (MSBS)' => ['msbs', 'biomedical science', 'molecular biology', 'pharmacology research']
//                 ]
//             ],

//             'Master Industrial, Manufacturing & Trades' => [
//                 'educ_level' => 'masters',
//                 'code' => 'MIMT',
//                 'skills' => [
//                     'Designing advanced automated manufacturing systems and cyber-physical production layouts', 'Applying Lean Six Sigma methodologies for operational excellence and waste reduction', 'Modeling complex industrial processes and structural lifecycle optimization schemas',
//                     'Formulating comprehensive industrial safety (OSHA) and environmental compliance architectures', 'Managing large-scale plant asset operations and predictive maintenance workflows', 'Analyzing advanced material properties, metallurgy, and industrial polymers engineering',
//                     'Integrating smart manufacturing architectures, industrial robotics, and IoT platforms', 'Evaluating manufacturing cost accounting frameworks and global standard constraints'
//                 ],
//                 'courses' => [
//                     'Master of Science in Industrial Engineering (MSIE)' => ['msie', 'industrial engineering graduate', 'operations research', 'systems engineering'],
//                     'Master of Science in Manufacturing Engineering (MSMFE)' => ['msmfe', 'manufacturing engineering masters', 'advanced automation', 'robotics'],
//                     'Master in Engineering Management (MEM)' => ['mem', 'engineering management', 'technical project management']
//                 ]
//             ],

//             'Master Finance & Legal Studies' => [
//                 'educ_level' => 'masters',
//                 'code' => 'MFLS',
//                 'skills' => [
//                     'Executing advanced financial engineering models and quantitative derivative pricing', 'Formulating corporate legal strategies, mergers, acquisitions, and compliance policies', 'Conducting complex macro-economic forecasting and econometric market analyses',
//                     'Evaluating systemic risk portfolios and corporate capital structural alternatives', 'Navigating complex cross-border international tax law and corporate governance metrics', 'Applying fintech solutions, algorithmic trading frameworks, and blockchain dynamics',
//                     'Drafting advanced legal briefs, international commercial treaties, and policy papers'
//                 ],
//                 'courses' => [
//                     'Master of Laws (LLM)' => ['llm', 'master of laws', 'corporate law', 'international jurisprudence', 'legal studies'],
//                     'Master of Science in Quantitative Finance (MSQF)' => ['msqf', 'quantitative finance', 'financial engineering', 'risk management'],
//                     'Master of Science in Economics (MSEcon)' => ['msecon', 'master in economics', 'econometrics', 'applied economics']
//                 ]
//             ],

//             'Master Agriculture, Forestry & Fisheries' => [
//                 'educ_level' => 'masters',
//                 'code' => 'MAFF',
//                 'skills' => [
//                     'Formulating sustainable agro-ecosystem models and climate-resilient farming systems', 'Designing advanced biotechnological solutions for crop breeding and soil mechanics', 'Managing commercial marine ecosystems, aquaculture hatcheries, and fish processing',
//                     'Evaluating forest resource conservation metrics and watershed management strategies', 'Analyzing agricultural economics markets, global supply paths, and food security policy', 'Applying geographic information systems (GIS) for spatial mapping and natural resource audits'
//                 ],
//                 'courses' => [
//                     'Master of Science in Agriculture (MSA)' => ['msa', 'agronomy', 'crop science', 'plant breeding', 'soil science'],
//                     'Master of Science in Forestry (MSF)' => ['msf', 'forestry graduate', 'forest conservation', 'silviculture'],
//                     'Master of Science in Aquaculture and Fisheries (MSAF)' => ['msaf', 'aquaculture', 'fisheries management', 'marine biology']
//                 ]
//             ],

//             'Master Tourism, Hospitality & Culinary Arts' => [
//                 'educ_level' => 'masters',
//                 'code' => 'MTHC',
//                 'skills' => [
//                     'Formulating macro-level sustainable tourism developments and strategic regional blueprints', 'Managing international hospitality asset portfolios and global hotel operations metrics', 'Analyzing international luxury tourism trends, consumer behaviors, and market positioning',
//                     'Developing destination marketing architectures and cross-cultural corporate events management', 'Evaluating food security, corporate gastronomy structures, and upscale culinary concepts', 'Navigating multinational hospitality labor relations, trade agreements, and safety codes'
//                 ],
//                 'courses' => [
//                     'Master of Science in Hospitality Management (MSHM)' => ['mshm', 'hospitality management graduate', 'hotel administration'],
//                     'Master of Science in Tourism Development (MSTD)' => ['mstd', 'tourism management', 'sustainable tourism', 'destination marketing'],
//                     'Master in Gastronomy and Culinary Management (MGCM)' => ['mgcm', 'gastronomy masters', 'culinary management', 'food culture']
//                 ]
//             ],

//             'Master Social Sciences & Community Services' => [
//                 'educ_level' => 'masters',
//                 'code' => 'MSSC',
//                 'skills' => [
//                     'Designing advanced sociological research layouts using specialized qualitative and quantitative models', 'Formulating sustainable community development frameworks and public policy structures', 'Executing clinical psychological assessments, diagnostics, and psychotherapeutic treatments',
//                     'Evaluating non-governmental organization (NGO) grant efficacy, funding paths, and field audits', 'Navigating systemic social issues, structural injustices, and human rights interventions', 'Leading dynamic conflict resolution, peace-building tracks, and social welfare programs'
//                 ],
//                 'courses' => [
//                     'Master of Science in Psychology (MSPsy)' => ['mspsy', 'clinical psychology', 'developmental psychology', 'psychometrics'],
//                     'Master of Public Administration (MPA)' => ['mpa', 'public administration', 'public policy', 'local government governance'],
//                     'Master of Social Work (MSW)' => ['msw', 'social work graduate', 'community development', 'social welfare']
//                 ]
//             ],

//             'Master Mathematics & Actuarial Sciences' => [
//                 'educ_level' => 'masters',
//                 'code' => 'MMAS',
//                 'skills' => [
//                     'Formulating strict mathematical proofs and abstract algebraic or topological structures', 'Modeling advanced predictive stochastic calculus tracks and multi-variable statistical matrices', 'Designing advanced cryptographical structures and information data security algorithms',
//                     'Calculating complex long-term actuarial financial risks, loss ratios, and insurance reserves', 'Executing advanced computational operations using MATLAB, R, or Python data libraries', 'Optimizing complex linear and non-linear numerical computational challenges'
//                 ],
//                 'courses' => [
//                     'Master of Science in Mathematics (MSMath)' => ['msmath', 'pure mathematics', 'applied mathematics', 'abstract algebra'],
//                     'Master of Science in Statistics (MSStat)' => ['msstat', 'data statistics', 'applied statistics', 'biostatistics'],
//                     'Master of Science in Actuarial Science (MSAS)' => ['msas', 'actuarial science', 'risk modeling', 'insurance mathematics']
//                 ]
//             ],

//             'Master Logistics, Supply Chain & Transportation' => [
//                 'educ_level' => 'masters',
//                 'code' => 'MLST',
//                 'skills' => [
//                     'Designing optimal global supply chain distribution architectures and complex networks', 'Formulating complex multimodal international transportation and distribution strategies', 'Applying inventory predictive models (EOQ, safety stock) to minimize logistics friction',
//                     'Managing massive warehouse operations, automated sortation arrays, and distribution hubs', 'Navigating international customs maritime laws, Incoterms, and cross-border shipping protocols', 'Analyzing procurement expenditures, strategic supplier pipelines, and total cost metrics'
//                 ],
//                 'courses' => [
//                     'Master of Science in Supply Chain Management (MSSCM)' => ['msscm', 'supply chain graduate', 'logistics engineering', 'operations sourcing'],
//                     'Master of Science in Transportation and Logistics (MSTL)' => ['mstl', 'transportation systems', 'maritime logistics', 'freight forwarding'],
//                     'Master in Global Logistics (MGL)' => ['mgl', 'global logistics', 'international procurement', 'distribution management']
//                 ]
//             ],

//             'Business & Corporate Governance' => [
//                 'educ_level' => 'doctorate',
//                 'code' => 'DBA_PHD',
//                 'skills' => [
//                     'Formulating novel, peer-reviewed econometric and organizational behavior theories', 'Conducting high-impact epistemological research on global market structures', 'Advising multinational boards on macro-level corporate governance policies',
//                     'Designing original qualitative and quantitative corporate research paradigms', 'Evaluating global systemic economic risks and macroeconomic trade disruptions', 'Authoring foundational business literature and paradigm-shifting economic frameworks'
//                 ],
//                 'courses' => [
//                     'Doctor of Business Administration (DBA)' => ['dba', 'doctor of business administration', 'executive business research'],
//                     'PhD in Management' => ['phd management', 'doctor of philosophy in management', 'organizational theory research'],
//                     'PhD in Economics' => ['phd economics', 'doctor of philosophy in economics', 'macroeconomic theory']
//                 ]
//             ],

//             'Advanced Computing & Intelligent Systems' => [
//                 'educ_level' => 'doctorate',
//                 'code' => 'DENG_CS',
//                 'skills' => [
//                     'Inventing novel machine learning architectures and artificial intelligence paradigms', 'Formulating mathematical proofs for algorithmic complexity and cryptographic limits', 'Directing national-level or enterprise-scale computational research labs',
//                     'Designing original distributed consensus mechanics and quantum computing frameworks', 'Authoring authoritative literature on computing ethics, data sovereignty, and technology policy', 'Securing research grants for pioneering hardware and software system designs'
//                 ],
//                 'courses' => [
//                     'PhD in Computer Science' => ['phd computer science', 'phd cs', 'advanced algorithm research'],
//                     'Doctor of Information Technology (DIT)' => ['dit', 'doctor of information technology', 'enterprise it governance'],
//                     'PhD in Data Science' => ['phd data science', 'doctorate in data science', 'computational statistics research']
//                 ]
//             ],

//             'Engineering, Innovation & Technology' => [
//                 'educ_level' => 'doctorate',
//                 'code' => 'PHD_ENG',
//                 'skills' => [
//                     'Pioneering novel materials science discoveries and structural mechanics paradigms', 'Modeling dynamic multi-physics systems mathematically to unlock engineering breakthroughs', 'Formulating long-term national infrastructure or industrial development frameworks',
//                     'Inventing advanced micro-electromechanical systems (MEMS) or automation protocols', 'Directing large-scale academic, governmental, or corporate R&D initiatives', 'Defending advanced patents and proprietary technological innovations at international levels'
//                 ],
//                 'courses' => [
//                     'PhD in Engineering' => ['phd engineering', 'doctor of philosophy in engineering', 'engineering r&d'],
//                     'Doctor of Engineering (EngD)' => ['engd', 'doctor of engineering', 'industrial innovation engineering'],
//                     'PhD in Material Science' => ['phd material science', 'nanotechnology research', 'advanced metallurgy']
//                 ]
//             ],

//             'Medical, Clinical & Life Sciences' => [
//                 'educ_level' => 'doctorate',
//                 'code' => 'PHD_MED',
//                 'skills' => [
//                     'Pioneering original oncology, immunology, or genomic molecular discoveries', 'Designing large-scale double-blind clinical trials and translational medicine protocols', 'Formulating macro-level global public health strategies and epidemiological frameworks',
//                     'Authoring authoritative clinical path guidelines for medical practitioners worldwide', 'Isolating novel biochemical pathways for pharmacological drug discovery pipelines', 'Evaluating complex bioethical dilemmas for international medical regulatory bodies'
//                 ],
//                 'courses' => [
//                     'PhD in Biomedical Sciences' => ['phd biomedical', 'molecular medicine research', 'pathology doctor'],
//                     'Doctor of Philosophy in Nursing (PhD)' => ['phd nursing', 'nursing theory development', 'clinical nursing research'],
//                     'PhD in Public Health' => ['phd public health', 'epidemiological modeling doctor', 'health policy design']
//                 ]
//             ],

//             'Education, Leadership & Pedagogy' => [
//                 'educ_level' => 'doctorate',
//                 'code' => 'EDD_PHD',
//                 'skills' => [
//                     'Formulating foundational pedagogical frameworks and learning theories', 'Directing high-stakes institutional or national educational accreditation audits', 'Designing systemic reforms for national primary, secondary, and tertiary curricula',
//                     'Conducting complex historical or philosophical research on educational policy', 'Pioneering structural methods for modern institutional governance and academic financing', 'Mentoring, publishing, and peer-reviewing post-graduate education literature'
//                 ],
//                 'courses' => [
//                     'Doctor of Education (EdD)' => ['edd', 'doctor of education', 'educational leadership administration'],
//                     'PhD in Education' => ['phd education', 'educational research philosophy', 'curriculum design scholar'],
//                     'Doctor of Philosophy in Higher Education' => ['phd higher education', 'university governance researcher']
//                 ]
//             ],

//             'Jurisprudence & Legal Philosophy' => [
//                 'educ_level' => 'doctorate',
//                 'code' => 'SJD_PHD',
//                 'skills' => [
//                     'Formulating novel legal interpretations, constitutional theories, and jurisprudence models', 'Drafting authoritative international treaties and structural model legislation frameworks', 'Conducting deep comparative legal audits across disparate sovereign jurisdictions',
//                     'Critiquing systemic human rights laws and global court enforcement architectures', 'Authoring seminal legal books, law review treatises, and public policy papers', 'Advising high courts, international tribunals, and legislative bodies on complex statutes'
//                 ],
//                 'courses' => [
//                     'Doctor of Juridical Science (SJD)' => ['sjd', 'doctor of juridical science', 'advanced legal scholar'],
//                     'PhD in Law' => ['phd law', 'legal philosophy doctor', 'jurisprudence research'],
//                     'PhD in Criminology and Criminal Justice' => ['phd criminology', 'criminal justice policy research']
//                 ]
//             ],

//             'Humanities, Social Sciences & Policy' => [
//                 'educ_level' => 'doctorate',
//                 'code' => 'PHD_HSS',
//                 'skills' => [
//                     'Formulating fundamental anthropological, historical, or sociological frameworks', 'Designing extensive, longitudinal human behavior and demographic field studies', 'Advising sovereign states on international relations, diplomacy, and geopolitical shifts',
//                     'Deconstructing complex systemic inequalities using advanced critical theory lenses', 'Directing large-scale psychological research programs or clinical testing protocols', 'Evaluating the socioeconomic outcomes of multi-billion dollar social welfare policies'
//                 ],
//                 'courses' => [
//                     'PhD in Psychology' => ['phd psychology', 'doctor of philosophy in psychology', 'clinical psychology research'],
//                     'PhD in Political Science' => ['phd political science', 'geopolitical strategy researcher', 'international relations scholar'],
//                     'PhD in Sociology' => ['phd sociology', 'sociological theory doctor', 'social policy research']
//                 ]
//             ],

//             'Pure Sciences, Mathematics & Physics' => [
//                 'educ_level' => 'doctorate',
//                 'code' => 'PHD_SCI',
//                 'skills' => [
//                     'Formulating abstract mathematical theorems, proofs, and algebraic properties', 'Modeling fundamental laws of universe dynamics, particle physics, and astrophysics', 'Designing highly complex multi-variable stochastic predictive statistical algorithms',
//                     'Pioneering novel chemical synthesis routes or atomic configuration layouts', 'Authoring paradigm-defining natural science literature and scientific observations', 'Operating ultra-high precision, national-level scientific arrays and laboratory instruments'
//                 ],
//                 'courses' => [
//                     'PhD in Physics' => ['phd physics', 'theoretical physics doctor', 'quantum mechanics research'],
//                     'PhD in Mathematics' => ['phd mathematics', 'pure mathematics doctor', 'applied mathematical proofs'],
//                     'PhD in Chemistry' => ['phd chemistry', 'organic chemistry researcher', 'molecular synthesis doctor']
//                 ]
//             ],
//         ];

//         // 2. Loop through and process insertion
//         foreach ($mappingMatrix as $areaName => $data) {

//             // Insert or find the record in your pre-existing expertises table
//             $expertise = Expertise::create([
//                 'exp_code'          => $data['code'],
//                 'area_of_expertise' => $areaName,
//                 'skills'            => json_encode($data['skills']), // Encoders to JSON for longtext format
//             ]);

//             // Insert related courses and their aliases
//             foreach ($data['courses'] as $courseDisplayName => $aliases) {

//                 $course = Course::create([
//                     'expertise_id' => $expertise->id,
//                     'display_name' => $courseDisplayName,
//                     'educ_level'   => $data['educ_level'],
//                 ]);

//                 foreach ($aliases as $alias) {
//                     CourseAlias::create([
//                         'course_id'     => $course->id,
//                         'alias_keyword' => strtolower(trim($alias)), // Ensure strings match normalization logic
//                     ]);
//                 }
//             }
//         }
//     }
// }
