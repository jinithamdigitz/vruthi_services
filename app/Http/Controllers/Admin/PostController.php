<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\GalleryCategory;
use App\Models\CommonSeoParameter;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

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
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'body'              => 'nullable|string',
            'post_category_id'  => 'required|exists:post_categories,id',
            'image'             => 'nullable|image|max:10240',
            'video_url'         => 'nullable|url',
            'published'         => 'sometimes',
            'featured'          => 'nullable|boolean',
            'gallery_category_id' => 'nullable|exists:gallery_categories,id',
            'keywords'          => 'nullable|string',
        ]);

        // Get the title for image naming
        $postTitle = $validated['title'];
        
        // slug
        $slug = Str::slug($postTitle);
        $original = $slug;
        $count = 2;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $count++;
        }
        $validated['slug'] = $slug;

        // Handle image upload
        if ($request->hasFile('image')) {
            try {
                $manager = new ImageManager(new Driver());
                
                // Create directory if not exists
                $uploadPath = public_path('posts');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
                
                // Generate filename from TITLE
                $imageName = Str::slug($postTitle) . '.webp';
                $imagePath = $uploadPath . '/' . $imageName;
                
                // Handle duplicate files
                $counter = 1;
                while (file_exists($imagePath)) {
                    $imageName = Str::slug($postTitle) . '-' . $counter . '.webp';
                    $imagePath = $uploadPath . '/' . $imageName;
                    $counter++;
                }
                
                // Read and process image
                $img = $manager->read($request->file('image')->getRealPath());
                
                // Resize if needed
                if ($img->width() > 1200) {
                    $img->scale(width: 1200);
                }
                
                // Save as WEBP with compression
                $img->toWebp(80)->save($imagePath);
                
                // Compress further if file is too large (optional additional compression)
                $fileSize = filesize($imagePath) / 1024;
                if ($fileSize > 100) {
                    $quality = 75;
                    $img->toWebp($quality)->save($imagePath);
                }
                
                $validated['image'] = 'posts/' . $imageName;
                
            } catch (\Exception $e) {
                // Fallback: Save original file if intervention fails
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('posts'), $imageName);
                $validated['image'] = 'posts/' . $imageName;
                
                \Log::error('Image conversion failed: ' . $e->getMessage());
            }
        }

        $validated['published'] = $request->has('published');
        $validated['featured'] = $request->boolean('featured');
        $validated['user_id'] = auth()->id();

        // Create the post
        $post = Post::create($validated);

        // Save keywords
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

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post created successfully.');
    }

    public function edit(Post $post)
    {
        $categories = PostCategory::pluck('name', 'id');
        $gallerycategories = GalleryCategory::pluck('name', 'id');

        $post->load('keywords');

        return view('admin.posts.edit', compact('post', 'categories', 'gallerycategories'));
    }
    
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'body'              => 'nullable|string',
            'post_category_id'  => 'required|exists:post_categories,id',
            'gallery_category_id' => 'nullable|exists:gallery_categories,id',
            'image'             => 'nullable|image|max:10240',
            'published'         => 'sometimes',
            'featured'          => 'nullable|boolean',
            'keywords'          => 'nullable|string',
            'video_url'         => 'nullable|url',
        ]);

        $postTitle = $validated['title'];

        // Generate new slug if title changes
        if ($post->title !== $postTitle) {
            $slug = Str::slug($postTitle);
            $original = $slug;
            $count = 2;
            while (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
                $slug = $original . '-' . $count++;
            }
            $validated['slug'] = $slug;
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($post->image && file_exists(public_path($post->image))) {
                unlink(public_path($post->image));
            }
            
            try {
                $manager = new ImageManager(new Driver());
                
                // Create directory if not exists
                $uploadPath = public_path('posts');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
                
                // Generate filename from TITLE
                $imageName = Str::slug($postTitle) . '.webp';
                $imagePath = $uploadPath . '/' . $imageName;
                
                // Handle duplicate files
                $counter = 1;
                while (file_exists($imagePath)) {
                    $imageName = Str::slug($postTitle) . '-' . $counter . '.webp';
                    $imagePath = $uploadPath . '/' . $imageName;
                    $counter++;
                }
                
                // Read and process image
                $img = $manager->read($request->file('image')->getRealPath());
                
                // Resize if needed
                if ($img->width() > 1200) {
                    $img->scale(width: 1200);
                }
                
                // Save as WEBP with compression
                $img->toWebp(80)->save($imagePath);
                
                $validated['image'] = 'posts/' . $imageName;
                
            } catch (\Exception $e) {
                // Fallback: Save original file
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('posts'), $imageName);
                $validated['image'] = 'posts/' . $imageName;
                
                \Log::error('Image conversion failed: ' . $e->getMessage());
            }
        }

        $validated['published'] = $request->has('published');
        $validated['featured'] = $request->boolean('featured');
        $validated['gallery_category_id'] = $request->filled('gallery_category_id') ? $request->gallery_category_id : null;

        $post->update($validated);

        if ($request->has('keywords')) {
            CommonSeoParameter::where('post_id', $post->id)->delete();
            
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

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        if ($post->image && file_exists(public_path($post->image))) {
            unlink(public_path($post->image));
        }
        
        $post->delete();
        
        return redirect()->route('admin.posts.index')
            ->with('success', 'Post deleted successfully.');
    }
}