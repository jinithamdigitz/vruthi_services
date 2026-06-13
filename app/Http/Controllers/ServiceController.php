<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    /**
     * Display a listing of the services (ADMIN PANEL)
     */
    public function index()
    {
        $services = Service::orderBy('sort_order', 'asc')->orderBy('id', 'desc')->paginate(10);
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
     * Sanitize HTML content based on show_html flag
     * Prevents XSS attacks while allowing safe HTML
     */
    private function sanitizeHtml($content, $allowHtml = false)
    {
        if (empty($content)) {
            return null;
        }

        if (!$allowHtml) {
            // Strip all HTML tags and escape special characters
            return htmlspecialchars(strip_tags($content), ENT_QUOTES, 'UTF-8');
        }

        // Allow safe HTML tags and attributes
        $allowedTags = '<p><br><strong><b><em><i><u><ul><ol><li><h1><h2><h3><h4><h5><h6><span><div><a><img><table><tr><td><th><thead><tbody><blockquote><pre><code>';
        
        // Strip disallowed tags
        $clean = strip_tags($content, $allowedTags);
        
        // Remove dangerous attributes like onerror, onload, etc.
        $clean = preg_replace('/\s(on\w+)\s*=\s*(["\']?)[^"\'>]*\2/i', '', $clean);
        
        // Remove javascript: protocol
        $clean = preg_replace('/javascript\s*:/i', '', $clean);
        
        // Escape any remaining unsafe characters
        return $clean;
    }

    /**
     * Process features array from JSON to database format
     */
    private function processFeatures($features, $showHtml = false)
    {
        if (empty($features)) {
            return null;
        }

        if (is_array($features)) {
            // If features is an array, sanitize each item
            $processed = [];
            foreach ($features as $feature) {
                $processed[] = $this->sanitizeHtml($feature, $showHtml);
            }
            return json_encode($processed);
        }

        // If features is a string (from CKEditor)
        return $this->sanitizeHtml($features, $showHtml);
    }

    /**
     * Store a newly created service (ADMIN PANEL)
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services,slug',
            'short_description' => 'nullable|string|max:500',
            'body' => 'nullable|string',
            'features' => 'nullable|string',
            'show_html' => 'nullable|in:0,1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'icon_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'keyword' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $service = new Service();
        $service->title = $request->title;
        
        // Handle short description
        $service->short_description = $this->sanitizeHtml($request->short_description, false);
        
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
        
        // Handle show_html flag (determines if HTML is allowed in body/features)
        $showHtml = $request->has('show_html') && $request->show_html == 1;
        $service->show_html = $showHtml;
        
        // Sanitize body based on show_html flag
        $service->body = $this->sanitizeHtml($request->body, $showHtml);
        
        // Sanitize features based on show_html flag
        $service->features = $this->processFeatures($request->features, $showHtml);
        
        $service->keyword = $this->sanitizeHtml($request->keyword, false);
        $service->sort_order = $request->sort_order ?? 0;
        $service->is_active = $request->has('is_active') ? $request->is_active : true;

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

        Log::info('Service created', ['id' => $service->id, 'title' => $service->title]);

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
        
        // Decode features if stored as JSON
        if ($service->features && $this->isJson($service->features)) {
            $service->features_array = json_decode($service->features, true);
        }
        
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Check if string is valid JSON
     */
    private function isJson($string)
    {
        if (!is_string($string)) {
            return false;
        }
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }

    /**
     * Update the specified service (ADMIN PANEL)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services,slug,' . $id,
            'short_description' => 'nullable|string|max:500',
            'body' => 'nullable|string',
            'features' => 'nullable|string',
            'show_html' => 'nullable|in:0,1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'icon_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'keyword' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $service = Service::findOrFail($id);
        $service->title = $request->title;
        
        // Handle short description
        $service->short_description = $this->sanitizeHtml($request->short_description, false);
        
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
        
        // Handle show_html flag
        $showHtml = $request->has('show_html') && $request->show_html == 1;
        $service->show_html = $showHtml;
        
        // Sanitize body based on show_html flag
        $service->body = $this->sanitizeHtml($request->body, $showHtml);
        
        // Sanitize features based on show_html flag
        $service->features = $this->processFeatures($request->features, $showHtml);
        
        $service->keyword = $this->sanitizeHtml($request->keyword, false);
        $service->sort_order = $request->sort_order ?? 0;
        $service->is_active = $request->has('is_active') ? $request->is_active : true;

        // Handle main image upload
        if ($request->hasFile('image')) {
            // Delete old image
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
            // Delete old icon
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

        Log::info('Service updated', ['id' => $service->id, 'title' => $service->title]);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified service (ADMIN PANEL)
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        
        // Delete main image
        if ($service->image && file_exists(public_path($service->image))) {
            unlink(public_path($service->image));
        }
        
        // Delete icon image
        if ($service->icon_image && file_exists(public_path($service->icon_image))) {
            unlink(public_path($service->icon_image));
        }
        
        $service->delete();

        Log::info('Service deleted', ['id' => $id, 'title' => $service->title]);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service deleted successfully.');
    }

    /**
     * Display the specified service by slug (FRONTEND)
     */
    public function showBySlug($slug)
    {
        $service = Service::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        
        // Decode features if stored as JSON
        if ($service->features && $this->isJson($service->features)) {
            $service->features_array = json_decode($service->features, true);
        }
        
        return view('services.show', compact('service'));
    }

    /**
     * Get all active services for frontend (FRONTEND)
     */
    public function frontendIndex()
    {
        $services = Service::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'asc')
            ->get();
        
        return view('services.index', compact('services'));
    }

    /**
     * Toggle service active status (AJAX)
     */
    public function toggleStatus($id)
    {
        $service = Service::findOrFail($id);
        $service->is_active = !$service->is_active;
        $service->save();
        
        return response()->json([
            'success' => true,
            'is_active' => $service->is_active,
            'message' => 'Service status updated successfully.'
        ]);
    }

    /**
     * Update sort order (AJAX for drag-drop)
     */
    public function updateSortOrder(Request $request)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*.id' => 'required|exists:services,id',
            'orders.*.sort_order' => 'required|integer|min:0',
        ]);

        foreach ($request->orders as $item) {
            Service::where('id', $item['id'])->update(['sort_order' => $item['sort_order']]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Sort order updated successfully.'
        ]);
    }
}