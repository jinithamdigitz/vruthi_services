<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoParameter;
use Illuminate\Http\Request;

class SeoParameterController extends Controller
{
    public function index()
    {
        $seoParameters = SeoParameter::all();
        return view('admin.seo.index', compact('seoParameters'));
    }

    public function create()
    {
        // Create an array of all routes in your application
        $routes = [
            '/' => 'Home',
            '/about' => 'About Us',
            '/services' => 'Services',
            '/portfolio' => 'Portfolio',
            '/blogs' => 'Blogs',
            '/contact' => 'Contact',
            '/programs' => 'Programs',
            '/events' => 'Events',
            '/projects' => 'Projects',
            '/facilities' => 'Facilities',
            // Add more routes as needed
        ];

        return view('admin.seo.create', compact('routes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'route_name' => 'required|string|unique:seo_parameters',
            'title' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'og_image' => 'nullable|image|max:2048'
        ]);

        $data = $request->except('_token');

        if ($request->hasFile('og_image')) {
            $imagePath = $request->file('og_image')->store('seo-images', 'public');
            $data['og_image'] = $imagePath;
        }

        SeoParameter::create($data);

        return redirect()->route('admin.seo.index')->with('success', 'SEO parameters created successfully');
    }

    public function edit($id)
    {
        $seoParameter = SeoParameter::findOrFail($id);
        $routes = [
            '/' => 'Home',
            '/about' => 'About Us',
            '/services' => 'Services',
            '/portfolio' => 'Portfolio',
            '/blogs' => 'Blogs',
            '/contact' => 'Contact',
            '/programs' => 'Programs',
            '/events' => 'Events',
            '/projects' => 'Projects',
            '/facilities' => 'Facilities',
        ];

        return view('admin.seo.edit', compact('seoParameter', 'routes'));
    }

    public function update(Request $request, $id)
    {
        $seoParameter = SeoParameter::findOrFail($id);

        $request->validate([
            'route_name' => 'required|string|unique:seo_parameters,route_name,' . $id,
            'title' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'og_image' => 'nullable|image|max:2048'
        ]);

        $data = $request->except('_token');

        if ($request->hasFile('og_image')) {
            $imagePath = $request->file('og_image')->store('seo-images', 'public');
            $data['og_image'] = $imagePath;
        }

        $seoParameter->update($data);

        return redirect()->route('admin.seo.index')->with('success', 'SEO parameters updated successfully');
    }

    public function show($id)
    {
        $seoParameter = SeoParameter::findOrFail($id);
        return view('admin.seo.show', compact('seoParameter'));
    }

    public function destroy($id)
    {
        $seoParameter = SeoParameter::findOrFail($id);
        $seoParameter->delete();

        return redirect()->route('admin.seo.index')->with('success', 'SEO parameters deleted successfully');
    }
}
