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

    /**
     * Compress and convert image to WEBP with SEO-friendly naming
     */
    private function compressAndConvertToWebp($image, $path, $baseName, $width = 800)
    {
        $manager = new ImageManager(new Driver());
        
        // Create directory if not exists
        if (!file_exists(public_path($path))) {
            mkdir(public_path($path), 0777, true);
        }
        
        $img = $manager->read($image->getRealPath());
        
        // Resize if width is greater than specified
        if ($img->width() > $width) {
            $img->scale(width: $width);
        }
        
        // Create filename with .webp extension
        $imageName = $baseName . '.webp';
        $imagePath = public_path($path . '/' . $imageName);
        
        // Handle duplicate files
        $count = 1;
        while (file_exists($imagePath)) {
            $imageName = $baseName . '-' . $count . '.webp';
            $imagePath = public_path($path . '/' . $imageName);
            $count++;
        }
        
        // Compress with quality loop (target ≤100KB)
        $quality = 80;
        do {
            $img->toWebp($quality)->save($imagePath);
            $size = filesize($imagePath) / 1024; // Size in KB
            $quality -= 5;
        } while ($size > 100 && $quality >= 40);
        
        return $path . '/' . $imageName;
    }

    public function store(Request $request)
    {
        $request->validate([
            'portfolio_category_id' => 'required|exists:portfolio_categories,id',
            'title' => 'required|string|max:255|unique:portfolios,title',
            'slug' => 'nullable|string|max:255|unique:portfolios,slug',
            'body' => 'required|string',
            'show_html' => 'nullable|in:0,1',
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
        $portfolio->show_html = $request->has('show_html') ? 1 : 0;
        $portfolio->location = $request->location;
        $portfolio->keywords = $request->keywords;

        // Handle image upload with SEO-friendly naming and compression
        if ($request->hasFile('image')) {
            $seoPrefix = ''; // Add prefix if needed (e.g., 'portfolio')
            $baseName = Str::slug($seoPrefix . ' ' . $portfolio->title);
            $portfolio->image = $this->compressAndConvertToWebp(
                $request->file('image'), 
                'uploads/portfolios', 
                $baseName,
                800
            );
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
            'show_html' => 'nullable|in:0,1',
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
        $portfolio->show_html = $request->has('show_html') ? 1 : 0;
        $portfolio->location = $request->location;
        $portfolio->keywords = $request->keywords;

        // Handle image upload with SEO-friendly naming and compression
        if ($request->hasFile('image')) {
            // Delete old image
            if ($portfolio->image && file_exists(public_path($portfolio->image))) {
                unlink(public_path($portfolio->image));
            }
            
            $seoPrefix = '';
            $baseName = Str::slug($seoPrefix . ' ' . $portfolio->title);
            $portfolio->image = $this->compressAndConvertToWebp(
                $request->file('image'), 
                'uploads/portfolios', 
                $baseName,
                800
            );
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