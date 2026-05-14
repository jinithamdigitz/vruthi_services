<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 

class PostCategoryController extends Controller
{
    public function index()
    {
        $categories = PostCategory::latest()->paginate(10);
        return view('admin.post_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.post_categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255'
        ]);

         $data['slug'] = Str::slug($data['name']);

    // if you want to ensure uniqueness, loop until slug is unique:
    $original = $data['slug'];
    $count = 2;
    while (PostCategory::where('slug', $data['slug'])->exists()) {
        $data['slug'] = $original . '-' . $count++;
    }

    PostCategory::create($data);

    return redirect()
        ->route('admin.post-categories.index')
        ->with('success', 'Category created successfully');
    }

    public function edit(PostCategory $postCategory)
    {
        return view('admin.post_categories.edit', compact('postCategory'));
    }

    public function update(Request $request, PostCategory $postCategory)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:post_categories,slug,' . $postCategory->id,
        ]);

        $postCategory->update($data);

        return redirect()->route('admin.post-categories.index')
            ->with('success', 'Category updated successfully');
    }

    public function destroy(PostCategory $postCategory)
    {
        $postCategory->delete();
        return redirect()->route('admin.post-categories.index')
            ->with('success', 'Category deleted successfully');
    }
}
