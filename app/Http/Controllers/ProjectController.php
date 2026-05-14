<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\PostCategory;
use App\Models\Post;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display portfolio listing page
     */
    public function portfolio()
    {
        $projects = Project::with('category')->latest()->paginate(9);
        $categories = ProjectCategory::withCount('projects')->get();
        $totalProjects = Project::count();
        
        // Get brand posts for layout (if needed by your layout)
        $category = PostCategory::where('slug', 'brand')->first();
        $brand = collect();
        if ($category) {
            $brand = Post::where('post_category_id', $category->id)->get();
        }
        
        return view('portfolio', compact('projects', 'categories', 'totalProjects', 'brand'));
    }


 public function projectlisting()
    {
        $projects = Project::with('category')->latest()->paginate(9);
        $categories = ProjectCategory::withCount('projects')->get();
        $totalProjects = Project::count();
        
        // Get brand posts for layout (if needed by your layout)
        $category = PostCategory::where('slug', 'brand')->first();
        $brand = collect();
        if ($category) {
            $brand = Post::where('post_category_id', $category->id)->get();
        }
        
        return view('projectlisting', compact('projects', 'categories', 'totalProjects', 'brand'));
    }



    /**
     * Display single project details - CHANGED TO USE SLUG
     */
    public function show($slug)  // Change parameter from $id to $slug
    {
        // Find the project with its category - CHANGE THIS LINE
        $project = Project::with('category')->where('slug', $slug)->firstOrFail();
        
        // Get related projects (same category, exclude current project)
        $relatedProjects = Project::with('category')
            ->where('project_category_id', $project->project_category_id)
            ->where('id', '!=', $project->id)
            ->latest()
            ->take(3)
            ->get();
        
        // If not enough related projects from same category, get latest projects
        if ($relatedProjects->count() < 3) {
            $additionalProjects = Project::with('category')
                ->where('id', '!=', $project->id)
                ->latest()
                ->take(3 - $relatedProjects->count())
                ->get();
            $relatedProjects = $relatedProjects->concat($additionalProjects);
        }
        
        // Get brand posts for layout (if needed by your layout)
        $category = PostCategory::where('slug', 'brand')->first();
        $brand = collect();
        if ($category) {
            $brand = Post::where('post_category_id', $category->id)->get();
        }
        
        return view('portfolio-details', [
            'project' => $project,
            'relatedProjects' => $relatedProjects,
            'brand' => $brand,
        ]);
    }

    /**
     * Filter projects by category - CHANGE TO USE SLUG
     */
    public function byCategory($slug)  // Change parameter from $id to $slug
    {
        $category = ProjectCategory::with('projects')->where('slug', $slug)->firstOrFail();  // Use slug to find category
        $categories = ProjectCategory::all();
        $projects = $category->projects;
        
        // Get brand posts for layout
        $brandCategory = PostCategory::where('slug', 'brand')->first();
        $brand = collect();
        if ($brandCategory) {
            $brand = Post::where('post_category_id', $brandCategory->id)->get();
        }
        
        return view('portfolio.category', compact('category', 'categories', 'projects', 'brand'));
    }
}