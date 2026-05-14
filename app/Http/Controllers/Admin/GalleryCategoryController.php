<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleryCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = GalleryCategory::ordered()->get();
        return view('admin.gallery-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gallery-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        GalleryCategory::create($validated);

        return redirect()->route('admin.gallery-categories.index')
                        ->with('success', 'Gallery category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(GalleryCategory $galleryCategory)
    {
        return view('admin.gallery-categories.show', compact('galleryCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GalleryCategory $galleryCategory)
    {
        return view('admin.gallery-categories.edit', compact('galleryCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GalleryCategory $galleryCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $galleryCategory->update($validated);

        return redirect()->route('admin.gallery-categories.index')
                        ->with('success', 'Gallery category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GalleryCategory $galleryCategory)
    {
        // Check if category has posts
        if ($galleryCategory->posts()->count() > 0) {
            return redirect()->back()
                            ->with('error', 'Cannot delete category that has posts. Please reassign posts first.');
        }

        $galleryCategory->delete();

        return redirect()->route('admin.gallery-categories.index')
                        ->with('success', 'Gallery category deleted successfully.');
    }
}