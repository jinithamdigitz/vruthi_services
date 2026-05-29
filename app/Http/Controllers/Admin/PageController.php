<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostCategory;
use App\Models\GalleryCategory;
use Illuminate\Support\Str;
use App\Models\Post;

class PageController extends Controller
{
    public function index($slug)
    {
        $posts = Post::join('post_categories', 'posts.post_category_id', '=', 'post_categories.id')
            ->where('post_categories.slug', $slug)
            ->with('category')
            ->select('posts.*')
            ->latest()
            ->paginate(10);

        return view('admin.pages.index', compact('posts', 'slug'));
    }

    public function create($slug)
    {
        $category = PostCategory::where('slug', $slug)->first();
        $categoryId = $category?->id;
        $categories = PostCategory::pluck('name', 'id');
        
        if($slug!="careers-banner"&&$slug!="career-highlights")
        {
            $galleryCategories = GalleryCategory::active()->pluck('name', 'id');
        } else {
            $galleryCategories =[];
        }

        return view('admin.pages.create', compact('categories', 'categoryId', 'slug', 'galleryCategories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'post_category_id' => 'required|exists:post_categories,id',
            'image' => 'nullable|image|max:10240',
            'video_url' => 'nullable|url',
            'multiple_images' => 'nullable|array',
            'multiple_images.*' => 'image|max:10240',
            'published' => 'sometimes',
            'gallery_category_id' => 'nullable|exists:gallery_categories,id',
            'keywords' => 'nullable|string',
            'slug' => 'nullable|string',
            'section_one_left' => 'nullable|string',
            'section_one_right' => 'nullable|string',
            'section_two_left' => 'nullable|string',
            'section_two_right' => 'nullable|string',
        ]);

        // Slug
        if ($request->has('slug') && !empty($request->slug)) {
            $slug = $request->slug;
        } else {
            $slug = Str::slug($request->title);
        }
        
        $original = $slug;
        $count = 2;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $count++;
        }
        $validated['slug'] = $slug;

        // ✅ MAIN IMAGE - FIXED: Use ONLY the title, no prefix
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            // Generate filename from TITLE only (NO prefix)
            $baseName = Str::slug($request->title);
            $fileName = $baseName . '.webp';
            $path = public_path('posts/' . $fileName);

            $count = 1;
            while (file_exists($path)) {
                $fileName = $baseName . '-' . $count . '.webp';
                $path = public_path('posts/' . $fileName);
                $count++;
            }

            // Compress and convert to WebP
            $manager = new \Intervention\Image\ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
            $img = $manager->read($image->getRealPath());
            
            if ($img->width() > 1200) {
                $img->scale(width: 1200);
            }
            
            $quality = 80;
            do {
                $img->toWebp($quality)->save($path);
                $size = filesize($path) / 1024;
                $quality -= 5;
            } while ($size > 100 && $quality >= 40);
            
            $validated['image'] = 'posts/' . $fileName;
        }

        $validated['published'] = $request->has('published');
        $validated['user_id'] = auth()->id();

        $post = Post::create($validated);

        // Keywords
        if ($request->filled('keywords')) {
            $keywords = explode(',', $request->keywords);
            foreach ($keywords as $keyword) {
                $keyword = trim($keyword);
                if (!empty($keyword)) {
                    \App\Models\CommonSeoParameter::create([
                        'post_id' => $post->id,
                        'keyword' => $keyword
                    ]);
                }
            }
        }

        // ✅ MULTIPLE IMAGES - FIXED: Use ONLY the title, no prefix
        if ($request->hasFile('multiple_images')) {
            foreach ($request->file('multiple_images') as $image) {
                $baseName = Str::slug($request->title);
                $fileName = $baseName . '.webp';
                $path = public_path('posts/' . $fileName);

                $count = 1;
                while (file_exists($path)) {
                    $fileName = $baseName . '-' . $count . '.webp';
                    $path = public_path('posts/' . $fileName);
                    $count++;
                }

                $manager = new \Intervention\Image\ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
                $img = $manager->read($image->getRealPath());
                
                if ($img->width() > 1200) {
                    $img->scale(width: 1200);
                }
                
                $img->toWebp(80)->save($path);

                \App\Models\MultiplePostImage::create([
                    'post_id' => $post->id,
                    'image_name' => 'posts/' . $fileName
                ]);
            }
        }

        return redirect()->route('admin.page.show', $post->id)
            ->with('success', 'Post created successfully with keywords.');
    }

    public function show($id)
    {
        $post = Post::where('id', $id)->first();
        $category = PostCategory::where('id', $post->post_category_id)->first();
        $slug = $category->slug;

        return view('admin.pages.show', compact('post', 'slug'));
    }

    public function edit(string $id)
    {
        $categories = PostCategory::pluck('name', 'id');
        $post = Post::where('id', $id)->first();
        $category = PostCategory::where('id', $post->post_category_id)->first();
        $slug = $category->slug;
        $galleryCategories = GalleryCategory::active()->pluck('name', 'id');

        return view('admin.pages.edit', compact('post', 'categories', 'slug', 'galleryCategories'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::where('id', $id)->first();
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'post_category_id' => 'required|exists:post_categories,id',
            'image' => 'nullable|image|max:10240',
            'video_url' => 'nullable|url',
            'multiple_images' => 'nullable|array',
            'multiple_images.*' => 'image|max:10240',
            'published' => 'sometimes',
            'gallery_category_id' => 'nullable|exists:gallery_categories,id',
            'keywords' => 'nullable|string',
            'slug' => 'nullable|string',
            'section_one_left' => 'nullable|string',
            'section_one_right' => 'nullable|string',
            'section_two_left' => 'nullable|string',
            'section_two_right' => 'nullable|string',
        ]);

        // Slug
        if ($request->has('slug') && !empty($request->slug)) {
            $slug = $request->slug;
        } else {
            $slug = Str::slug($validated['title']);
        }

        $original = $slug;
        $count = 2;
        while (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
            $slug = $original . '-' . $count++;
        }
        $validated['slug'] = $slug;

        // ✅ MAIN IMAGE UPDATE - FIXED: Use ONLY the title, no prefix
        if ($request->hasFile('image')) {
            if ($post->image && file_exists(public_path($post->image))) {
                unlink(public_path($post->image));
            }

            $image = $request->file('image');
            
            // Generate filename from TITLE only (NO prefix)
            $baseName = Str::slug($request->title);
            $fileName = $baseName . '.webp';
            $path = public_path('posts/' . $fileName);

            $count = 1;
            while (file_exists($path)) {
                $fileName = $baseName . '-' . $count . '.webp';
                $path = public_path('posts/' . $fileName);
                $count++;
            }

            // Compress and convert to WebP
            $manager = new \Intervention\Image\ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
            $img = $manager->read($image->getRealPath());
            
            if ($img->width() > 1200) {
                $img->scale(width: 1200);
            }
            
            $quality = 80;
            do {
                $img->toWebp($quality)->save($path);
                $size = filesize($path) / 1024;
                $quality -= 5;
            } while ($size > 100 && $quality >= 40);
            
            $validated['image'] = 'posts/' . $fileName;
        }

        $validated['published'] = $request->has('published');
        $post->update($validated);

        // Keywords update
        if ($request->has('keywords')) {
            \App\Models\CommonSeoParameter::where('post_id', $post->id)->delete();

            $keywords = explode(',', $request->keywords);
            foreach ($keywords as $keyword) {
                $keyword = trim($keyword);
                if (!empty($keyword)) {
                    \App\Models\CommonSeoParameter::create([
                        'post_id' => $post->id,
                        'keyword' => $keyword
                    ]);
                }
            }
        }

        // ✅ MULTIPLE IMAGES UPDATE - FIXED: Use ONLY the title, no prefix
        if ($request->hasFile('multiple_images')) {
            foreach ($request->file('multiple_images') as $image) {
                $baseName = Str::slug($request->title);
                $fileName = $baseName . '.webp';
                $path = public_path('posts/' . $fileName);

                $count = 1;
                while (file_exists($path)) {
                    $fileName = $baseName . '-' . $count . '.webp';
                    $path = public_path('posts/' . $fileName);
                    $count++;
                }

                $manager = new \Intervention\Image\ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
                $img = $manager->read($image->getRealPath());
                
                if ($img->width() > 1200) {
                    $img->scale(width: 1200);
                }
                
                $img->toWebp(80)->save($path);

                \App\Models\MultiplePostImage::create([
                    'post_id' => $post->id,
                    'image_name' => 'posts/' . $fileName
                ]);
            }
        }

        return redirect()->route('admin.page.show', $post->id)
            ->with('success', 'Post updated successfully with keywords.');
    }

    public function destroy(string $id)
    {
        $post = Post::where('id', $id)->first();

        $categoryId = $post->post_category_id;
        $PostCategory = PostCategory::where('id', $categoryId)->first();
        $slug = $PostCategory->slug;

        if ($post->image && file_exists(public_path($post->image))) {
            unlink(public_path($post->image));
        }

        if ($post->og_image && file_exists(public_path($post->og_image))) {
            unlink(public_path($post->og_image));
        }

        $post->delete();

        return redirect()->route('admin.page.index', $slug)->with('success', 'Post deleted successfully.');
    }

    public function renameSeoImages()
    {
        $posts = \App\Models\Post::all();

        foreach ($posts as $post) {
            if (!$post->image) continue;

            $oldPath = public_path($post->image);
            if (!file_exists($oldPath)) continue;

            // Use ONLY the title for new name (NO prefix)
            $baseName = Str::slug($post->title);
            $newFileName = $baseName . '.webp';
            $newPath = public_path('posts/' . $newFileName);

            $count = 1;
            while (file_exists($newPath)) {
                $newFileName = $baseName . '-' . $count . '.webp';
                $newPath = public_path('posts/' . $newFileName);
                $count++;
            }

            // Convert to WebP if not already
            $manager = new \Intervention\Image\ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
            $img = $manager->read($oldPath);
            
            if ($img->width() > 1200) {
                $img->scale(width: 1200);
            }
            
            $quality = 80;
            do {
                $img->toWebp($quality)->save($newPath);
                $size = filesize($newPath) / 1024;
                $quality -= 5;
            } while ($size > 100 && $quality >= 40);
            
            unlink($oldPath);

            $post->image = 'posts/' . $newFileName;
            $post->save();
        }

        return "✅ Post images renamed and converted to WebP successfully";
    }
}