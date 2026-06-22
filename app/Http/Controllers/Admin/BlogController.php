<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of blogs
     */
    public function index()
    {
        $blogs = Blog::withoutGlobalScopes()->orderBy('sort_order')->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new blog
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created blog in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug($validated['title']) . '.' . $file->getClientOriginalExtension();
            
            // Create uploads/blogs directory if it doesn't exist
            $uploadPath = public_path('uploads/blogs');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            // Store directly in public folder
            $file->move($uploadPath, $filename);
            $validated['image'] = 'uploads/blogs/' . $filename;
        }

        $validated['slug'] = Str::slug($validated['title']);
        $validated['sort_order'] = Blog::withoutGlobalScopes()->max('sort_order') + 1;

        Blog::create($validated);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully');
    }

    /**
     * Show the form for editing the specified blog
     */
    public function edit(Blog $blog)
    {
        $blog = $blog->withoutGlobalScopes()->find($blog->id);
        return view('admin.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified blog in storage
     */
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($blog->image && file_exists(public_path($blog->image))) {
                unlink(public_path($blog->image));
            }
            
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug($validated['title']) . '.' . $file->getClientOriginalExtension();
            
            // Create uploads/blogs directory if it doesn't exist
            $uploadPath = public_path('uploads/blogs');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            // Store directly in public folder
            $file->move($uploadPath, $filename);
            $validated['image'] = 'uploads/blogs/' . $filename;
        }

        $validated['slug'] = Str::slug($validated['title']);
        $blog->update($validated);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully');
    }

    /**
     * Remove the specified blog from storage
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully');
    }

    /**
     * Update blog order via AJAX
     */
    public function updateOrder(Request $request)
    {
        $order = $request->input('order');
        
        foreach ($order as $index => $id) {
            Blog::withoutGlobalScopes()->where('id', $id)->update(['sort_order' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }
}
