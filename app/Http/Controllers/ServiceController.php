<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;  // Add this for GD driver

class ServiceController extends Controller
{
    /**
     * Display a listing of the services.
     */
    public function index()
    {
        $services = Service::orderBy('id', 'desc')->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new service.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created service in storage.
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
        
        if ($request->filled('slug')) {
            $service->slug = Str::slug($request->slug);
        } else {
            $service->slug = Str::slug($request->title);
        }
        
        $service->body = $request->body;
        $service->keyword = $request->keyword;

        // Handle main image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.webp';
            
            if (!file_exists(public_path('uploads/services'))) {
                mkdir(public_path('uploads/services'), 0777, true);
            }
            
            // Correct way for Intervention Image 3.x
            $manager = new ImageManager(new Driver());
            $img = $manager->read($image->getRealPath());
            
            if ($img->width() > 1200) {
                $img->scale(width: 1200);
            }
            
            $img->toWebp(75)->save(public_path('uploads/services/' . $imageName));
            $service->image = 'uploads/services/' . $imageName;
        }

        // Handle icon image upload
        if ($request->hasFile('icon_image')) {
            $iconImage = $request->file('icon_image');
            $iconName = time() . '_icon.webp';
            
            if (!file_exists(public_path('uploads/services/icons'))) {
                mkdir(public_path('uploads/services/icons'), 0777, true);
            }
            
            $manager = new ImageManager(new Driver());
            $icon = $manager->read($iconImage->getRealPath());
            $icon->scale(width: 128, height: 128);
            $icon->toWebp(85)->save(public_path('uploads/services/icons/' . $iconName));
            
            $service->icon_image = 'uploads/services/icons/' . $iconName;
        }

        $service->save();

        return redirect()->route('services.index')
            ->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified service.
     */
    public function show($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified service in storage.
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
        
        if ($request->filled('slug')) {
            $service->slug = Str::slug($request->slug);
        } else {
            $service->slug = Str::slug($request->title);
        }
        
        $service->body = $request->body;
        $service->keyword = $request->keyword;

        // Handle main image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($service->image && file_exists(public_path($service->image))) {
                unlink(public_path($service->image));
            }
            
            $image = $request->file('image');
            $imageName = time() . '.webp';
            
            if (!file_exists(public_path('uploads/services'))) {
                mkdir(public_path('uploads/services'), 0777, true);
            }
            
            $manager = new ImageManager(new Driver());
            $img = $manager->read($image->getRealPath());
            
            if ($img->width() > 1200) {
                $img->scale(width: 1200);
            }
            
            $img->toWebp(75)->save(public_path('uploads/services/' . $imageName));
            $service->image = 'uploads/services/' . $imageName;
        }

        // Handle icon image upload
        if ($request->hasFile('icon_image')) {
            // Delete old icon
            if ($service->icon_image && file_exists(public_path($service->icon_image))) {
                unlink(public_path($service->icon_image));
            }
            
            $iconImage = $request->file('icon_image');
            $iconName = time() . '_icon.webp';
            
            if (!file_exists(public_path('uploads/services/icons'))) {
                mkdir(public_path('uploads/services/icons'), 0777, true);
            }
            
            $manager = new ImageManager(new Driver());
            $icon = $manager->read($iconImage->getRealPath());
            $icon->scale(width: 128, height: 128);
            $icon->toWebp(85)->save(public_path('uploads/services/icons/' . $iconName));
            
            $service->icon_image = 'uploads/services/icons/' . $iconName;
        }

        $service->save();

        return redirect()->route('services.index')
            ->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified service from storage.
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

        return redirect()->route('services.index')
            ->with('success', 'Service deleted successfully.');
    }

    /**
     * Display the specified service by slug (for frontend).
     */
    public function showBySlug($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        return view('services.show', compact('service'));
    }

    /**
     * Get all services for frontend.
     */
    public function frontendIndex()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }
}