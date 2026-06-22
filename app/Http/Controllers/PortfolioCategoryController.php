<?php
// app/Http/Controllers/PortfolioCategoryController.php

namespace App\Http\Controllers;

use App\Models\PortfolioCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PortfolioCategoryController extends Controller
{
    public function index()
    {
        $categories = PortfolioCategory::withCount('portfolios')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('admin.portfolio-categories.index', compact('categories'));
    }

    /**
     * Display the specified portfolio category.
     */
    public function show(PortfolioCategory $portfolioCategory)
    {
        $portfolioCategory->load('portfolios');
        return view('admin.portfolio-categories.show', compact('portfolioCategory'));
    }

    public function create()
    {
        return view('admin.portfolio-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:portfolio_categories,name',
            'slug' => 'nullable|string|max:255|unique:portfolio_categories,slug',
            'keywords' => 'nullable|string|max:500'
        ]);

        $category = new PortfolioCategory();
        $category->name = $request->name;

        if ($request->filled('slug')) {
            $category->slug = Str::slug($request->slug);
        } else {
            $category->slug = Str::slug($request->name);
        }

        $category->keywords = $request->keywords;
        $category->save();

        return redirect()->route('admin.portfolio-categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit(PortfolioCategory $portfolioCategory)
    {
        return view('admin.portfolio-categories.edit', compact('portfolioCategory'));
    }

    public function update(Request $request, PortfolioCategory $portfolioCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:portfolio_categories,name,' . $portfolioCategory->id,
            'slug' => 'nullable|string|max:255|unique:portfolio_categories,slug,' . $portfolioCategory->id,
            'keywords' => 'nullable|string|max:500'
        ]);

        $portfolioCategory->name = $request->name;

        if ($request->filled('slug')) {
            $portfolioCategory->slug = Str::slug($request->slug);
        } else {
            $portfolioCategory->slug = Str::slug($request->name);
        }

        $portfolioCategory->keywords = $request->keywords;
        $portfolioCategory->save();

        return redirect()->route('admin.portfolio-categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(PortfolioCategory $portfolioCategory)
    {
        try {
            $categoryName = $portfolioCategory->name;
            $portfolioCount = $portfolioCategory->portfolios()->count();
            
            // Delete all associated portfolios with their images
            if ($portfolioCount > 0) {
                foreach ($portfolioCategory->portfolios as $portfolio) {
                    // Delete portfolio image if exists
                    if ($portfolio->image && file_exists(public_path($portfolio->image))) {
                        unlink(public_path($portfolio->image));
                    }
                    $portfolio->delete();
                }
            }
            
            // Delete the category
            $portfolioCategory->delete();

            return redirect()->route('admin.portfolio-categories.index')
                ->with('success', "Category '{$categoryName}' and its {$portfolioCount} associated portfolio(s) deleted successfully.");
                
        } catch (\Exception $e) {
            return redirect()->route('admin.portfolio-categories.index')
                ->with('error', 'Error deleting category: ' . $e->getMessage());
        }
    }

    /**
     * Toggle category status (AJAX)
     */
    public function toggleStatus(PortfolioCategory $portfolioCategory)
    {
        $portfolioCategory->is_active = !$portfolioCategory->is_active;
        $portfolioCategory->save();

        return response()->json([
            'success' => true,
            'is_active' => $portfolioCategory->is_active,
            'message' => 'Status updated successfully.'
        ]);
    }
}