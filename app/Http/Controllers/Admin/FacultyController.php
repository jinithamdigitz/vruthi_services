<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faculties = Faculty::latest()->paginate(10);
        return view('admin.faculties.index', compact('faculties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.faculties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'keyword' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'qualification' => 'nullable|string|max:500',
            'experience' => 'nullable|string|max:500',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('faculties', 'public');
            $data['image'] = $imagePath;
        }

        Faculty::create($data);

        return redirect()->route('admin.faculties.index')
            ->with('success', 'Faculty created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Faculty $faculty)
    {
        return view('admin.faculties.show', compact('faculty'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faculty $faculty)
    {
        return view('admin.faculties.edit', compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faculty $faculty)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'keyword' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'qualification' => 'nullable|string|max:500',
            'experience' => 'nullable|string|max:500',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image
            if ($faculty->image && Storage::disk('public')->exists($faculty->image)) {
                Storage::disk('public')->delete($faculty->image);
            }
            
            $imagePath = $request->file('image')->store('faculties', 'public');
            $data['image'] = $imagePath;
        }

        $faculty->update($data);

        return redirect()->route('admin.faculties.index')
            ->with('success', 'Faculty updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faculty $faculty)
    {
        // Delete image if exists
        if ($faculty->image && Storage::disk('public')->exists($faculty->image)) {
            Storage::disk('public')->delete($faculty->image);
        }
        
        $faculty->delete();

        return redirect()->route('admin.faculties.index')
            ->with('success', 'Faculty deleted successfully.');
    }
}