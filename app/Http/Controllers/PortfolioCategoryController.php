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
        $categories = PortfolioCategory::orderBy('id', 'desc')->paginate(10);
        return view('admin.portfolio-categories.index', compact('categories'));
    }
    /**
     * Display the specified portfolio category.
     */
    public function show(PortfolioCategory $portfolioCategory)
    {
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
        if ($portfolioCategory->portfolios()->count() > 0) {
            return redirect()->route('admin.portfolio-categories.index')
                ->with('error', 'Cannot delete category. It has associated portfolios.');
        }

        $portfolioCategory->delete();

        return redirect()->route('admin.portfolio-categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
