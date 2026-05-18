<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Str;

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
            'body' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'keyword' => 'nullable|string|max:255',
        ]);

        $service = new Service();
        $service->title = $request->title;
        $service->slug = Str::slug($request->title);
        $service->body = $request->body;
        $service->keyword = $request->keyword;

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/services'), $imageName);
            $service->image = 'uploads/services/' . $imageName;
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
            'body' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'keyword' => 'nullable|string|max:255',
        ]);

        $service = Service::findOrFail($id);
        $service->title = $request->title;
        $service->slug = Str::slug($request->title);
        $service->body = $request->body;
        $service->keyword = $request->keyword;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($service->image && file_exists(public_path($service->image))) {
                unlink(public_path($service->image));
            }
            
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/services'), $imageName);
            $service->image = 'uploads/services/' . $imageName;
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
        
        // Delete image if exists
        if ($service->image && file_exists(public_path($service->image))) {
            unlink(public_path($service->image));
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