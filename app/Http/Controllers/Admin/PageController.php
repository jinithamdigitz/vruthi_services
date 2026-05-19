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
		
		}else
		{
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
				// ✅ New fields
				'section_one_left' => 'nullable|string',
				'section_one_right' => 'nullable|string',
				'section_two_left' => 'nullable|string',
				'section_two_right' => 'nullable|string',
			]);

        // Slug
        if ($request->has('slug') && !empty($request->slug)) {
        // Use the posted slug
            $slug = $request->slug;
        } else {
            // Generate slug from title
            $slug = \Str::slug($request->title);
        }
            
        $original = $slug;
        $count = 2;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $count++;
        }
        $validated['slug'] = $slug;

        // ✅ MAIN IMAGE
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();

            $seoPrefix = 'printing services in kerala';
            $baseName = Str::slug($seoPrefix . ' ' . $request->title);

            $fileName = $baseName . '.' . $extension;
            $path = public_path('posts/' . $fileName);

            $count = 1;
            while (file_exists($path)) {
                $fileName = $baseName . '-' . $count . '.' . $extension;
                $path = public_path('posts/' . $fileName);
                $count++;
            }

            $image->move(public_path('posts'), $fileName);
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

        // ✅ MULTIPLE IMAGES
        if ($request->hasFile('multiple_images')) {

            foreach ($request->file('multiple_images') as $image) {

                $extension = $image->getClientOriginalExtension();

                $seoPrefix = 'printing services in kerala';
                $baseName = Str::slug($seoPrefix . ' ' . $request->title);

                $fileName = $baseName . '.' . $extension;
                $path = public_path('posts/' . $fileName);

                $count = 1;
                while (file_exists($path)) {
                    $fileName = $baseName . '-' . $count . '.' . $extension;
                    $path = public_path('posts/' . $fileName);
                    $count++;
                }

                $image->move(public_path('posts'), $fileName);

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
				// ✅ New fields
				'section_one_left' => 'nullable|string',
				'section_one_right' => 'nullable|string',
				'section_two_left' => 'nullable|string',
				'section_two_right' => 'nullable|string',
			]);

    
        // Slug
        if ($request->has('slug') && !empty($request->slug)) {
        // Use the posted slug
            $slug = $request->slug;
        } else {
            // Generate slug from title
            $slug = Str::slug($validated['title']);
           
        }

         $original = $slug;
            $count = 2;
            while (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
                $slug = $original . '-' . $count++;
            }
            $validated['slug'] = $slug;
        

        // Slug update
      

        // ✅ MAIN IMAGE UPDATE
        if ($request->hasFile('image')) {

            if ($post->image && file_exists(public_path($post->image))) {
                unlink(public_path($post->image));
            }

            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();

            $seoPrefix = 'printing services in kerala';
            $baseName = Str::slug($seoPrefix . ' ' . $request->title);

            $fileName = $baseName . '.' . $extension;
            $path = public_path('posts/' . $fileName);

            $count = 1;
            while (file_exists($path)) {
                $fileName = $baseName . '-' . $count . '.' . $extension;
                $path = public_path('posts/' . $fileName);
                $count++;
            }

            $image->move(public_path('posts'), $fileName);
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

        // ✅ MULTIPLE IMAGES UPDATE
        if ($request->hasFile('multiple_images')) {

            foreach ($request->file('multiple_images') as $image) {

                $extension = $image->getClientOriginalExtension();

                $seoPrefix = 'printing services in kerala';
                $baseName = Str::slug($seoPrefix . ' ' . $request->title);

                $fileName = $baseName . '.' . $extension;
                $path = public_path('posts/' . $fileName);

                $count = 1;
                while (file_exists($path)) {
                    $fileName = $baseName . '-' . $count . '.' . $extension;
                    $path = public_path('posts/' . $fileName);
                    $count++;
                }

                $image->move(public_path('posts'), $fileName);

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
    $seoPrefix = 'printing services in kerala';

    // 🔥 POSTS (main images)
    $posts = \App\Models\Post::all();

    foreach ($posts as $post) {

        if (!$post->image) continue;

        $oldPath = public_path($post->image);
        if (!file_exists($oldPath)) continue;

        $extension = pathinfo($oldPath, PATHINFO_EXTENSION);

        $baseName = \Illuminate\Support\Str::slug($seoPrefix . ' ' . $post->title);

        $newFileName = $baseName . '.' . $extension;
        $newPath = public_path('posts/' . $newFileName);

        $count = 1;
        while (file_exists($newPath)) {
            $newFileName = $baseName . '-' . $count . '.' . $extension;
            $newPath = public_path('posts/' . $newFileName);
            $count++;
        }

        rename($oldPath, $newPath);

        $post->image = 'posts/' . $newFileName;
        $post->save();
    }

    // 🔥 MULTIPLE POST IMAGES
    $images = \App\Models\MultiplePostImage::all();

    foreach ($images as $img) {

        if (!$img->image_name) continue;

        $oldPath = public_path($img->image_name);
        if (!file_exists($oldPath)) continue;

        $post = \App\Models\Post::find($img->post_id);
        if (!$post) continue;

        $extension = pathinfo($oldPath, PATHINFO_EXTENSION);

        $baseName = \Illuminate\Support\Str::slug($seoPrefix . ' ' . $post->title);

        $newFileName = $baseName . '.' . $extension;
        $newPath = public_path('posts/' . $newFileName);

        $count = 1;
        while (file_exists($newPath)) {
            $newFileName = $baseName . '-' . $count . '.' . $extension;
            $newPath = public_path('posts/' . $newFileName);
            $count++;
        }

        rename($oldPath, $newPath);

        $img->image_name = 'posts/' . $newFileName;
        $img->save();
    }

    return "✅ Post images renamed successfully";
}
}