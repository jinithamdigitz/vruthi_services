<?php

namespace Database\Seeders;

use App\Models\Certification;
use Illuminate\Database\Seeder;

class CertificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $certifications = [
            [
                'title' => 'ISO 9001:2015',
                'subtitle' => 'Quality Management System',
                'icon' => 'bi-patch-check',
                'sort_order' => 1,
            ],
            [
                'title' => 'ISO 14001:2015',
                'subtitle' => 'Environmental Management',
                'icon' => 'bi-shield-check',
                'sort_order' => 2,
            ],
            [
                'title' => 'ISO 401:2018',
                'subtitle' => 'Occupational Safety Management',
                'icon' => 'bi-file-earmark-check',
                'sort_order' => 3,
            ],
            [
                'title' => 'MSME',
                'subtitle' => 'Registered Company',
                'icon' => 'bi-award',
                'sort_order' => 4,
            ],
            [
                'title' => 'Startup India',
                'subtitle' => 'Recognized Entity',
                'icon' => 'bi-star',
                'sort_order' => 5,
            ],
            [
                'title' => 'GeM',
                'subtitle' => 'Government & Marketplace',
                'icon' => 'bi-building-check',
                'sort_order' => 6,
            ],
        ];

        foreach ($certifications as $certification) {
            Certification::create($certification);
        }
    }
}
