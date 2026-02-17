<?php

namespace Database\Seeders;
use Illuminate\Support\Str;
use App\Models\Expertise;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpertiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mapping Areas to their specific Sub-category Skills
        $expertiseMap = [
            'Technology & IT'            => 'Web Development, Software Development, Network Security',
            'Creative & Design'          => 'Graphic Design, Video Editing, UI/UX Design',
            'Business & Administration'  => 'Data Entry, Office Management, Project Coordination',
            'Marketing & Sales'          => 'Social Media Marketing, SEO, Lead Generation',
            'Healthcare & Life Sciences' => 'Nursing Care, Medical Research, Patient Documentation',
            'Education & Training'       => 'Curriculum Development, Online Tutoring, Classroom Management',
            'Finance & Legal'            => 'Bookkeeping, Legal Research, Tax Preparation',
            'Logistics & Supply Chain'   => 'Inventory Management, Shipping Coordination, Warehousing',
            'Human Resources'            => 'Recruitment, Employee Relations, Payroll Processing',
            'Research'                   => 'Data Analysis, Market Research, Technical Writing',
            'IT Management'              => 'IT Strategy, Team Leadership, Systems Administration'
        ];

        foreach ($expertiseMap as $name => $skills) {
            $shortSlug = Str::lower(Str::substr(Str::slug($name), 0, 5));

            Expertise::factory()->create([
                'area_of_expertise' => $name,
                'exp_code'          => $shortSlug,
                'skills'            => $skills, // Your new column name
            ]);
        }
    }
}
