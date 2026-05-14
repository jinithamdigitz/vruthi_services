<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\MultipleImage;

class MultipleImageController extends Controller
{
    public function store(Request $request, $programId)
    {
        $program = Program::findOrFail($programId);

        $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        foreach ($request->file('images') as $imageFile) {
            $path = $imageFile->store('program_multiple_images', 'public');
            MultipleImage::create([
                'name' => $path,
                'program_id' => $program->id,
            ]);
        }

        return redirect()->back()->with('success', 'Images uploaded successfully!');
    }
}
