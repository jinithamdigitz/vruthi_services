<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\ServiceImage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    // ✅ COMMON FUNCTION (SEO NAME GENERATOR)
    private function generateSeoName($title)
    {
        $prefix = 'printing-services-kerala';

        // limit title length (important)
        $titleSlug = Str::slug(Str::limit($title, 40, ''));

        return $prefix . '-' . $titleSlug;
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Slug
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;
        while (Service::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        // 🔥 MAIN IMAGE
        $imageName = null;

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();

            $baseName = $this->generateSeoName($request->title);

            $imageName = $baseName . '.' . $extension;
            $path = public_path('uploads/services/' . $imageName);

            $count = 1;
            while (file_exists($path)) {
                $imageName = $baseName . '-' . $count . '.' . $extension;
                $path = public_path('uploads/services/' . $imageName);
                $count++;
            }

            $image->move(public_path('uploads/services'), $imageName);
        }

        $service = Service::create([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        // 🔥 GALLERY
        if ($request->hasFile('gallery')) {

            foreach ($request->file('gallery') as $galleryImage) {

                $extension = $galleryImage->getClientOriginalExtension();

                $baseName = $this->generateSeoName($request->title);

                $name = $baseName . '.' . $extension;
                $path = public_path('uploads/service-gallery/' . $name);

                $count = 1;
                while (file_exists($path)) {
                    $name = $baseName . '-' . $count . '.' . $extension;
                    $path = public_path('uploads/service-gallery/' . $name);
                    $count++;
                }

                $galleryImage->move(public_path('uploads/service-gallery'), $name);

                ServiceImage::create([
                    'service_id' => $service->id,
                    'image' => $name
                ]);
            }
        }

        return redirect()->route('admin.services.index')
            ->with('success', 'Service created successfully');
    }

    public function show(Service $service)
    {
        $service->load('images');
        return view('admin.services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        $service->load('images');
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Slug update
        if ($service->title !== $request->title) {
            $slug = Str::slug($request->title);
            $originalSlug = $slug;
            $count = 1;
            while (Service::where('slug', $slug)->where('id', '!=', $service->id)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
            $service->slug = $slug;
        }

        // 🔥 MAIN IMAGE UPDATE
        $imageName = $service->image;

        if ($request->hasFile('image')) {

            if ($service->image && file_exists(public_path('uploads/services/' . $service->image))) {
                unlink(public_path('uploads/services/' . $service->image));
            }

            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();

            $baseName = $this->generateSeoName($request->title);

            $imageName = $baseName . '.' . $extension;
            $path = public_path('uploads/services/' . $imageName);

            $count = 1;
            while (file_exists($path)) {
                $imageName = $baseName . '-' . $count . '.' . $extension;
                $path = public_path('uploads/services/' . $imageName);
                $count++;
            }

            $image->move(public_path('uploads/services'), $imageName);
        }

        $service->update([
            'title' => $request->title,
            'slug' => $service->slug,
            'image' => $imageName,
        ]);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully');
    }

    // 🔥 BULK RENAME EXISTING IMAGES
    public function renameSeoImages()
    {
        $services = Service::all();

        foreach ($services as $service) {

            // MAIN IMAGE
            if ($service->image) {

                $oldPath = public_path('uploads/services/' . $service->image);

                if (file_exists($oldPath)) {

                    $ext = pathinfo($oldPath, PATHINFO_EXTENSION);
                    $baseName = $this->generateSeoName($service->title);

                    $newName = $baseName . '.' . $ext;
                    $newPath = public_path('uploads/services/' . $newName);

                    $count = 1;
                    while (file_exists($newPath)) {
                        $newName = $baseName . '-' . $count . '.' . $ext;
                        $newPath = public_path('uploads/services/' . $newName);
                        $count++;
                    }

                    rename($oldPath, $newPath);

                    $service->image = $newName;
                    $service->save();
                }
            }

            // GALLERY
            foreach ($service->images as $img) {

                $oldPath = public_path('uploads/service-gallery/' . $img->image);

                if (file_exists($oldPath)) {

                    $ext = pathinfo($oldPath, PATHINFO_EXTENSION);
                    $baseName = $this->generateSeoName($service->title);

                    $newName = $baseName . '.' . $ext;
                    $newPath = public_path('uploads/service-gallery/' . $newName);

                    $count = 1;
                    while (file_exists($newPath)) {
                        $newName = $baseName . '-' . $count . '.' . $ext;
                        $newPath = public_path('uploads/service-gallery/' . $newName);
                        $count++;
                    }

                    rename($oldPath, $newPath);

                    $img->image = $newName;
                    $img->save();
                }
            }
        }

        return "✅ Service images renamed successfully";
    }

    public function destroy(Service $service)
    {
        if ($service->image && file_exists(public_path('uploads/services/' . $service->image))) {
            unlink(public_path('uploads/services/' . $service->image));
        }

        foreach ($service->images as $gallery) {
            if ($gallery->image && file_exists(public_path('uploads/service-gallery/' . $gallery->image))) {
                unlink(public_path('uploads/service-gallery/' . $gallery->image));
            }
        }

        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service deleted successfully');
    }

    public function serviceDetail($slug)
    {
        $service = Service::with('images')->where('slug', $slug)->firstOrFail();
        return view('service-detail', compact('service'));
    }
}