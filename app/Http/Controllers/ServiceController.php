<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ServiceController extends Controller
{
    /**
     * Display a listing of the services (ADMIN PANEL)
     */
    public function index()
    {
        $services = Service::orderBy('id', 'desc')->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new service (ADMIN PANEL)
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Compress and convert image to WEBP with SEO-friendly naming
     */
    private function compressAndConvertToWebp($image, $path, $baseName, $width = 1200)
    {
        $manager = new ImageManager(new Driver());
        
        if (!file_exists(public_path($path))) {
            mkdir(public_path($path), 0777, true);
        }
        
        $img = $manager->read($image->getRealPath());
        
        if ($img->width() > $width) {
            $img->scale(width: $width);
        }
        
        $imageName = $baseName . '.webp';
        $imagePath = public_path($path . '/' . $imageName);
        
        $count = 1;
        while (file_exists($imagePath)) {
            $imageName = $baseName . '-' . $count . '.webp';
            $imagePath = public_path($path . '/' . $imageName);
            $count++;
        }
        
        $quality = 80;
        do {
            $img->toWebp($quality)->save($imagePath);
            $size = filesize($imagePath) / 1024;
            $quality -= 5;
        } while ($size > 100 && $quality >= 40);
        
        return $path . '/' . $imageName;
    }

    /**
     * Store a newly created service (ADMIN PANEL)
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services,slug',
            'body' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'icon_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'keyword' => 'nullable|string|max:255',
        ]);

        $service = new Service();
        $service->title = $request->title;
        
        // Handle unique slug
        if ($request->filled('slug')) {
            $baseSlug = Str::slug($request->slug);
        } else {
            $baseSlug = Str::slug($request->title);
        }
        
        $slug = $baseSlug;
        $counter = 1;
        while (Service::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }
        $service->slug = $slug;
        
        $service->body = $request->body;
        $service->keyword = $request->keyword;

        // Handle main image upload
        if ($request->hasFile('image')) {
            $baseName = Str::slug($service->title);
            $service->image = $this->compressAndConvertToWebp(
                $request->file('image'), 
                'uploads/services', 
                $baseName
            );
        }

        // Handle icon image upload
        if ($request->hasFile('icon_image')) {
            $baseName = Str::slug($service->title . '-icon');
            
            $manager = new ImageManager(new Driver());
            
            if (!file_exists(public_path('uploads/services/icons'))) {
                mkdir(public_path('uploads/services/icons'), 0777, true);
            }
            
            $icon = $manager->read($request->file('icon_image')->getRealPath());
            $icon->scale(width: 128, height: 128);
            
            $iconName = $baseName . '.webp';
            $iconPath = public_path('uploads/services/icons/' . $iconName);
            
            $count = 1;
            while (file_exists($iconPath)) {
                $iconName = $baseName . '-' . $count . '.webp';
                $iconPath = public_path('uploads/services/icons/' . $iconName);
                $count++;
            }
            
            $icon->toWebp(85)->save($iconPath);
            $service->icon_image = 'uploads/services/icons/' . $iconName;
        }

        $service->save();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified service (ADMIN PANEL)
     */
    public function show($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified service (ADMIN PANEL)
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified service (ADMIN PANEL)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services,slug,' . $id,
            'body' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'icon_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'keyword' => 'nullable|string|max:255',
        ]);

        $service = Service::findOrFail($id);
        $service->title = $request->title;
        
        // Handle unique slug for update
        if ($request->filled('slug')) {
            $baseSlug = Str::slug($request->slug);
        } else {
            $baseSlug = Str::slug($request->title);
        }
        
        if ($baseSlug !== $service->slug) {
            $slug = $baseSlug;
            $counter = 1;
            while (Service::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            $service->slug = $slug;
        }
        
        $service->body = $request->body;
        $service->keyword = $request->keyword;

        // Handle main image upload
        if ($request->hasFile('image')) {
            if ($service->image && file_exists(public_path($service->image))) {
                unlink(public_path($service->image));
            }
            
            $baseName = Str::slug($service->title);
            $service->image = $this->compressAndConvertToWebp(
                $request->file('image'), 
                'uploads/services', 
                $baseName
            );
        }

        // Handle icon image upload
        if ($request->hasFile('icon_image')) {
            if ($service->icon_image && file_exists(public_path($service->icon_image))) {
                unlink(public_path($service->icon_image));
            }
            
            $baseName = Str::slug($service->title . '-icon');
            
            $manager = new ImageManager(new Driver());
            
            if (!file_exists(public_path('uploads/services/icons'))) {
                mkdir(public_path('uploads/services/icons'), 0777, true);
            }
            
            $icon = $manager->read($request->file('icon_image')->getRealPath());
            $icon->scale(width: 128, height: 128);
            
            $iconName = $baseName . '.webp';
            $iconPath = public_path('uploads/services/icons/' . $iconName);
            
            $count = 1;
            while (file_exists($iconPath)) {
                $iconName = $baseName . '-' . $count . '.webp';
                $iconPath = public_path('uploads/services/icons/' . $iconName);
                $count++;
            }
            
            $icon->toWebp(85)->save($iconPath);
            $service->icon_image = 'uploads/services/icons/' . $iconName;
        }

        $service->save();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified service (ADMIN PANEL)
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        
        if ($service->image && file_exists(public_path($service->image))) {
            unlink(public_path($service->image));
        }
        
        if ($service->icon_image && file_exists(public_path($service->icon_image))) {
            unlink(public_path($service->icon_image));
        }
        
        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service deleted successfully.');
    }

    /**
     * Display the specified service by slug (FRONTEND)
     */
    public function showBySlug($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        return view('services.show', compact('service'));
    }

    /**
     * Get all services for frontend (FRONTEND)
     */
    public function frontendIndex()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }
}