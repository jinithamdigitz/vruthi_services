<?php
// app/Http/Controllers/PortfolioController.php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::with('category')->orderBy('id', 'desc')->paginate(10);
        return view('admin.portfolios.index', compact('portfolios'));
    }
    /**
     * Display the specified portfolio.
     */
    public function show(Portfolio $portfolio)
    {
        $portfolio->load('category');
        return view('admin.portfolios.show', compact('portfolio'));
    }

    public function create()
    {
        $categories = PortfolioCategory::all();
        return view('admin.portfolios.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'portfolio_category_id' => 'required|exists:portfolio_categories,id',
            'title' => 'required|string|max:255|unique:portfolios,title',
            'slug' => 'nullable|string|max:255|unique:portfolios,slug',
            'body' => 'required|string',
            'location' => 'nullable|string|max:255',
            'keywords' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120'
        ]);

        $portfolio = new Portfolio();
        $portfolio->portfolio_category_id = $request->portfolio_category_id;
        $portfolio->title = $request->title;

        if ($request->filled('slug')) {
            $portfolio->slug = Str::slug($request->slug);
        } else {
            $portfolio->slug = Str::slug($request->title);
        }

        $portfolio->body = $request->body;
        $portfolio->location = $request->location;
        $portfolio->keywords = $request->keywords;

        // Handle image upload with compression and WebP conversion
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.webp';

            // Create directory if not exists
            if (!file_exists(public_path('uploads/portfolios'))) {
                mkdir(public_path('uploads/portfolios'), 0777, true);
            }

            // Process image with Intervention
            $manager = new ImageManager(new Driver());
            $img = $manager->read($image->getRealPath());

            // Resize if width is greater than 800px
            if ($img->width() > 800) {
                $img->scale(width: 800);
            }

            // Save as WebP with 80% quality
            $img->toWebp(80)->save(public_path('uploads/portfolios/' . $imageName));
            $portfolio->image = 'uploads/portfolios/' . $imageName;
        }

        $portfolio->save();

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portfolio created successfully.');
    }

    public function edit(Portfolio $portfolio)
    {
        $categories = PortfolioCategory::all();
        return view('admin.portfolios.edit', compact('portfolio', 'categories'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $request->validate([
            'portfolio_category_id' => 'required|exists:portfolio_categories,id',
            'title' => 'required|string|max:255|unique:portfolios,title,' . $portfolio->id,
            'slug' => 'nullable|string|max:255|unique:portfolios,slug,' . $portfolio->id,
            'body' => 'required|string',
            'location' => 'nullable|string|max:255',
            'keywords' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120'
        ]);

        $portfolio->portfolio_category_id = $request->portfolio_category_id;
        $portfolio->title = $request->title;

        if ($request->filled('slug')) {
            $portfolio->slug = Str::slug($request->slug);
        } else {
            $portfolio->slug = Str::slug($request->title);
        }

        $portfolio->body = $request->body;
        $portfolio->location = $request->location;
        $portfolio->keywords = $request->keywords;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($portfolio->image && file_exists(public_path($portfolio->image))) {
                unlink(public_path($portfolio->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.webp';

            // Create directory if not exists
            if (!file_exists(public_path('uploads/portfolios'))) {
                mkdir(public_path('uploads/portfolios'), 0777, true);
            }

            // Process image with Intervention
            $manager = new ImageManager(new Driver());
            $img = $manager->read($image->getRealPath());

            // Resize if width is greater than 800px
            if ($img->width() > 800) {
                $img->scale(width: 800);
            }

            // Save as WebP with 80% quality
            $img->toWebp(80)->save(public_path('uploads/portfolios/' . $imageName));
            $portfolio->image = 'uploads/portfolios/' . $imageName;
        }

        $portfolio->save();

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portfolio updated successfully.');
    }

    public function destroy(Portfolio $portfolio)
    {
        // Delete image file
        if ($portfolio->image && file_exists(public_path($portfolio->image))) {
            unlink(public_path($portfolio->image));
        }

        $portfolio->delete();

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portfolio deleted successfully.');
    }

    // Frontend Methods
    public function portfolio()
    {
        $categories = PortfolioCategory::with('portfolios')->get();
        $portfolios = Portfolio::with('category')->orderBy('id', 'desc')->paginate(12);
        return view('portfolio', compact('categories', 'portfolios'));
    }

    
}
