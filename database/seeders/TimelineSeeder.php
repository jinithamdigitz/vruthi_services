<?php

namespace Database\Seeders;

use App\Models\Timeline;
use Illuminate\Database\Seeder;

class TimelineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timelines = [
            [
                'year' => 2007,
                'title' => 'Company',
                'description' => 'Established',
                'icon' => 'bi-rocket-takeoff',
                'sort_order' => 1,
            ],
            [
                'year' => 2010,
                'title' => 'Expanded Operations',
                'description' => 'Across North India',
                'icon' => 'bi-buildings',
                'sort_order' => 2,
            ],
            [
                'year' => 2013,
                'title' => '500+ Clients',
                'description' => 'Onboarded',
                'icon' => 'bi-people-fill',
                'sort_order' => 3,
            ],
            [
                'year' => 2016,
                'title' => 'Entered',
                'description' => 'Middle East Market',
                'icon' => 'bi-globe2',
                'sort_order' => 4,
            ],
            [
                'year' => 2019,
                'title' => '10,000+',
                'description' => 'Workforce Strength',
                'icon' => 'bi-person-badge',
                'sort_order' => 5,
            ],
            [
                'year' => 2022,
                'title' => 'ISO Certified',
                'description' => 'Processes',
                'icon' => 'bi-patch-check',
                'sort_order' => 6,
            ],
            [
                'year' => 2024,
                'title' => 'Continuing Growth,',
                'description' => 'Delivering Excellence.',
                'icon' => 'bi-graph-up-arrow',
                'sort_order' => 7,
            ],
        ];

        foreach ($timelines as $timeline) {
            Timeline::create($timeline);
        }
    }
}
