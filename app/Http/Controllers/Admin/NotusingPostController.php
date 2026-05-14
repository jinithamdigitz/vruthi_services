<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\GalleryCategory;
use App\Models\CommonSeoParameter; // Add this

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category', 'keywords')->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = PostCategory::pluck('name', 'id');
        $galleryCategories = GalleryCategory::pluck('name', 'id');

        return view('admin.posts.create', compact(
            'categories',
            'galleryCategories'
        ));
    }

  public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'title' => 'required|string|max:255',
        'slug' => 'nullable|string|max:255|unique:posts,slug',
        'body' => 'nullable|string',
        'section_one_left' => 'nullable|string',
        'section_one_right' => 'nullable|string',
        'section_two_left' => 'nullable|string',
        'section_two_right' => 'nullable|string',
        'post_category_id' => 'required|exists:post_categories,id',
        'image' => 'nullable|image|max:10240',
        'video_url' => 'nullable|url',
        'published' => 'sometimes',
        'featured' => 'nullable|boolean',
        'gallery_category_id' => 'nullable|exists:gallery_categories,id',
        'keywords' => 'nullable|string',
    ]);

    // Handle main image upload
    $mainImagePath = '';
    if ($request->hasFile('image')) {
        $filename = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('posts'), $filename);
        $mainImagePath = 'posts/' . $filename;
    }

    // Generate slug
    $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);
    $existingSlug = Post::where('slug', $slug)->exists();
    if ($existingSlug) {
        $slug = $slug . '-' . time();
    }

    // Create the post
    $post = Post::create([
        'title' => $request->title,
        'slug' => $slug,
        'body' => $request->body,
        'section_one_left' => $request->section_one_left,
        'section_one_right' => $request->section_one_right,
        'section_two_left' => $request->section_two_left,
        'section_two_right' => $request->section_two_right,
        'post_category_id' => $request->post_category_id,
        'image' => $mainImagePath,
        'video_url' => $request->video_url,
        'published' => $request->has('published'),
        'featured' => $request->boolean('featured'),
        'gallery_category_id' => $request->gallery_category_id,
        'user_id' => auth()->id(),
    ]);

    // Save keywords using the post_id
    if ($request->filled('keywords')) {
        $keywords = explode(',', $request->keywords);
        foreach ($keywords as $keyword) {
            $keyword = trim($keyword);
            if (!empty($keyword)) {
                CommonSeoParameter::create([
                    'post_id' => $post->id,
                    'keyword' => $keyword
                ]);
            }
        }
    }

    return redirect()
        ->route('admin.posts.index')
        ->with('success', 'Post created successfully!');
}

    public function edit(Post $post)
    {
        $categories = PostCategory::pluck('name', 'id');
        $gallerycategories = GalleryCategory::pluck('name', 'id');

        // Load keywords relationship
        $post->load('keywords');

        return view('admin.posts.edit', compact('post', 'categories', 'gallerycategories'));
    }

    public function update(Request $request, Post $post)
    {
        \Log::info('=== UPDATE METHOD START ===');
        \Log::info('Request data:', $request->all());

        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'body'              => 'nullable|string',
            'post_category_id'  => 'required|exists:post_categories,id',
            'gallery_category_id' => 'nullable|exists:gallery_categories,id',
            'image'             => 'nullable|image|max:10240',
            'published'         => 'sometimes',
            'featured'          => 'nullable|boolean',
            // REPLACE SEO fields with keywords
            'keywords'          => 'nullable|string', // Add this
            'video_url' => 'nullable|url',
        ]);

        \Log::info('Validated data:', $validated);

        // Generate new slug if title changes
        if ($post->title !== $validated['title']) {
            $slug = Str::slug($validated['title']);
            $original = $slug;
            $count = 2;
            while (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
                $slug = $original . '-' . $count++;
            }
            $validated['slug'] = $slug;
        }

        // Handle main image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($post->image && file_exists(public_path($post->image))) {
                unlink(public_path($post->image));
            }
            $filename = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('posts'), $filename);
            $validated['image'] = 'posts/' . $filename;
        }

        // REMOVE OG image handling code

        // Handle checkbox values
        $validated['published'] = $request->has('published');
        $validated['featured'] = $request->boolean('featured');

        // Handle gallery_category_id - set to null if empty
        $validated['gallery_category_id'] = $request->filled('gallery_category_id') ? $request->gallery_category_id : null;

        \Log::info('Final data to update:', $validated);

        // Update the post
        $post->update($validated);

        // Update keywords - delete old and add new
        if ($request->has('keywords')) {
            // Delete all existing keywords for this post
            CommonSeoParameter::where('post_id', $post->id)->delete();

            // Add new keywords
            $keywords = explode(',', $request->keywords);
            foreach ($keywords as $keyword) {
                $keyword = trim($keyword);
                if (!empty($keyword)) {
                    CommonSeoParameter::create([
                        'post_id' => $post->id,
                        'keyword' => $keyword
                    ]);
                }
            }
        }

        \Log::info('=== UPDATE METHOD END ===');

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post updated successfully with keywords.');
    }

    public function destroy(Post $post)
    {
        // Delete main image
        if ($post->image && file_exists(public_path($post->image))) {
            unlink(public_path($post->image));
        }

        // REMOVE OG image deletion - keywords will be deleted automatically by foreign key if set up correctly

        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post deleted successfully.');
    }
}
