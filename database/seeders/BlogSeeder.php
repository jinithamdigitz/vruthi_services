<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogs = [
            [
                'title' => 'Facility Management Trends Every Business Should Know',
                'body' => 'Explore the latest facility management practices helping organizations stay productive and efficient.',
                'image' => 'img/blogs/blog-1.jpg',
                'sort_order' => 1,
            ],
            [
                'title' => 'Strategic Workforce Solutions for Growing Businesses',
                'body' => 'Discover how strategic workforce management helps scale your business efficiently.',
                'image' => 'img/blogs/blog-2.jpg',
                'sort_order' => 2,
            ],
            [
                'title' => 'Transforming Workforce Management Through Strategic Outsourcing',
                'body' => 'Discover how modern outsourcing solutions help businesses improve efficiency, reduce operational costs and scale faster.',
                'image' => 'img/blogs/blog-3.jpg',
                'sort_order' => 3,
            ],
            [
                'title' => 'The Future of Facility Management in 2026',
                'body' => 'Learn about emerging technologies and best practices shaping facility management.',
                'image' => 'img/blogs/blog-4.jpg',
                'sort_order' => 4,
            ],
            [
                'title' => 'Cost-Effective Outsourcing Strategies',
                'body' => 'Find out how to optimize costs while maintaining service quality through smart outsourcing.',
                'image' => 'img/blogs/blog-5.jpg',
                'sort_order' => 5,
            ],
            [
                'title' => 'Digital Transformation in Facility Operations',
                'body' => 'Explore how digital tools are revolutionizing facility management operations.',
                'image' => 'img/blogs/blog-6.jpg',
                'sort_order' => 6,
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::create([
                'title' => $blog['title'],
                'slug' => Str::slug($blog['title']),
                'body' => $blog['body'],
                'image' => $blog['image'],
                'sort_order' => $blog['sort_order'],
            ]);
        }
    }
}
