<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display all courses
     */
    public function index()
    {
        $courses = Course::latest()->get();

        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.courses.create');
    }

    /**
     * Store new course
     */
    public function store(Request $request)
    {
        $request->validate([

            'course_name' => 'required',
            'description' => 'required',
            'duration' => 'required',
            'image' => 'required|image',
            'keyword' => 'nullable'

        ]);

        // Upload Image
        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(public_path('uploads/courses'), $imageName);

        // Store Data
        Course::create([

            'course_name' => $request->course_name,
            'description' => $request->description,
            'duration' => $request->duration,
            'image' => 'uploads/courses/' . $imageName,
            'keyword' => $request->keyword

        ]);

        return redirect('/admin/courses')
            ->with('success', 'Course Created Successfully');
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id);

        return view('admin.courses.edit', compact('course'));
    }

    /**
     * Update course
     */
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $request->validate([

            'course_name' => 'required',
            'description' => 'required',
            'duration' => 'required',
            'image' => 'nullable|image',
            'keyword' => 'nullable'

        ]);

        $imagePath = $course->image;

        // Update Image
        if ($request->hasFile('image')) {

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('uploads/courses'), $imageName);

            $imagePath = 'uploads/courses/' . $imageName;
        }

        // Update Data
        $course->update([

            'course_name' => $request->course_name,
            'description' => $request->description,
            'duration' => $request->duration,
            'image' => $imagePath,
            'keyword' => $request->keyword

        ]);

        return redirect('/admin/courses')
            ->with('success', 'Course Updated Successfully');
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);

        return view('admin.courses.show', compact('course'));
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        $course->delete();

        return redirect('/admin/courses')
            ->with('success', 'Course Deleted Successfully');
    }
}
