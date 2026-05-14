<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MultipleImage;
use App\Models\Program;
use App\Models\ProgramMultipleImage;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::all();
        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.programs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:250',
            'description' => 'nullable|string|max:2500',
            'image' => 'nullable|image|max:2048',
            'created_date' => 'nullable|date',
			'start_date' => 'nullable|date',
		   'end_date' => 'nullable|date',
           // 'multiple_images.*' => 'image|max:2048',
        ]);

        // Handle main image upload and store in public/Program_images directory
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('Program_images'), $imageName);
            $validated['image'] = 'Program_images/' . $imageName;
        }

        $program = Program::create($validated);

        // Handle multiple images upload and store in public/Program_multiple_images directory
        if ($request->hasFile('multiple_images')) {
            foreach ($request->file('multiple_images') as $multipleImage) {
                $multipleImageName = time() . '_' . $multipleImage->getClientOriginalName();
                $multipleImage->move(public_path('Program_multiple_images'), $multipleImageName);
                MultipleImage::create([
                    'name' => 'Program_multiple_images/' . $multipleImageName,
                    'program_id' => $program->id,
                ]);
            }
        }


        return redirect()->route('admin.programs.index')->with('success', 'Program created!');
    }

    public function show($id)
    {
        $program = Program::with('multipleImages')->findOrFail($id);
        return view('admin.programs.show', compact('program'));
    }

    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:250',
            'description' => 'nullable|string|max:2500',
            'image' => 'nullable|image|max:2048',
            'created_date' => 'nullable|date',
			'start_date' => 'nullable|date',
		   'end_date' => 'nullable|date',
           // 'multiple_images.*' => 'image|max:2048',
        ]);

        // Overwrite main image if new one is uploaded
        if ($request->hasFile('image')) {
            // Delete old image file if exists
            if ($program->image && file_exists(public_path($program->image))) {
                unlink(public_path($program->image));
            }
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('Program_images'), $imageName);
            $validated['image'] = 'Program_images/' . $imageName;
        }

        $program->update($validated);

        // Add new extra images (does not delete existing ones)
        if ($request->hasFile('multiple_images')) {
            foreach ($request->file('multiple_images') as $multipleImage) {
                $multipleImageName = time() . '_' . $multipleImage->getClientOriginalName();
                $multipleImage->move(public_path('Program_multiple_images'), $multipleImageName);
                ProgramMultipleImage::create([
                    'name' => 'Program_multiple_images/' . $multipleImageName,
                    'Program_id' => $Program->id,
                ]);
            }
        }

        return redirect()->route('admin.programs.index')->with('success', 'Program updated!');
    }

    public function destroy(Program $program)
    {
        // Delete main image file if exists
        if ($program->image && file_exists(public_path($program->image))) {
            unlink(public_path($program->image));
        }

        // Delete all related multiple images files and DB rows
        foreach ($Program->multipleImages as $multipleImage) {
            if (file_exists(public_path($multipleImage->name))) {
                unlink(public_path($multipleImage->name));
            }
            $multipleImage->delete();
        }

        $program->delete();

        return redirect()->route('admin.programs.index')->with('success', 'Program deleted!');
    }
}
