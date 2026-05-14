<?php

namespace App\Http\Controllers;

use App\Models\ProjectCategory;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectCategoryController extends Controller
{
    /**
     * Display all categories for frontend
     */
    public function index()
    {
        $categories = ProjectCategory::withCount('projects')->latest()->get();
        
        return view('portfolio.categories', compact('categories'));
    }

    /**
     * Display single category with its projects
     */
    public function show($id)
    {
        $category = ProjectCategory::with('projects')->findOrFail($id);
        $allCategories = ProjectCategory::withCount('projects')->get();
        
        return view('portfolio.category-detail', compact('category', 'allCategories'));
    }
    public function getProjects($id)
    {
        $projects = Project::where('project_category_id', $id)
                           ->with('category')
                           ->latest()
                           ->get();
        
        return response()->json([
            'success' => true,
            'category' => ProjectCategory::find($id),
            'projects' => $projects
        ]);
    }

    /**
     * Get category stats
     */
    public function getStats()
    {
        $stats = ProjectCategory::withCount('projects')->get();
        
        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }
}