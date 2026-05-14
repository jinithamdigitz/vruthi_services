<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectCategoryController extends Controller
{
    public function index()
    {
        $categories = ProjectCategory::latest()->paginate(10);
        return view('admin.project-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.project-categories.create');
    }

    // ✅ COMMON SEO NAME FUNCTION
    private function generateSeoName($name)
    {
        $prefix = 'printing-services-kerala';
        $slug = Str::slug(Str::limit($name, 40, ''));

        return $prefix . '-' . $slug;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['name']);

        // 🔥 IMAGE (SEO)
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $extension = $image->extension();

            $baseName = $this->generateSeoName($request->name);

            $imageName = $baseName . '.' . $extension;
            $path = public_path('uploads/categories/' . $imageName);

            $count = 1;
            while (file_exists($path)) {
                $imageName = $baseName . '-' . $count . '.' . $extension;
                $path = public_path('uploads/categories/' . $imageName);
                $count++;
            }

            $image->move(public_path('uploads/categories'), $imageName);
            $data['image'] = 'uploads/categories/' . $imageName;
        }

        ProjectCategory::create($data);

        return redirect()->route('admin.project-categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit(ProjectCategory $projectCategory)
    {
        return view('admin.project-categories.edit', compact('projectCategory'));
    }

    public function update(Request $request, ProjectCategory $projectCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['name']);

        // 🔥 IMAGE UPDATE (SEO)
        if ($request->hasFile('image')) {

            if ($projectCategory->image && file_exists(public_path($projectCategory->image))) {
                unlink(public_path($projectCategory->image));
            }

            $image = $request->file('image');
            $extension = $image->extension();

            $baseName = $this->generateSeoName($request->name);

            $imageName = $baseName . '.' . $extension;
            $path = public_path('uploads/categories/' . $imageName);

            $count = 1;
            while (file_exists($path)) {
                $imageName = $baseName . '-' . $count . '.' . $extension;
                $path = public_path('uploads/categories/' . $imageName);
                $count++;
            }

            $image->move(public_path('uploads/categories'), $imageName);
            $data['image'] = 'uploads/categories/' . $imageName;
        }

        $projectCategory->update($data);

        return redirect()->route('admin.project-categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(ProjectCategory $projectCategory)
    {
        if ($projectCategory->projects()->count() > 0) {
            return redirect()->route('admin.project-categories.index')
                ->with('error', 'Cannot delete category with associated projects.');
        }

        if ($projectCategory->image && file_exists(public_path($projectCategory->image))) {
            unlink(public_path($projectCategory->image));
        }

        $projectCategory->delete();

        return redirect()->route('admin.project-categories.index')
            ->with('success', 'Category deleted successfully.');
    }

    // 🔥 BULK RENAME EXISTING CATEGORY IMAGES
    public function renameSeoImages()
    {
        $categories = ProjectCategory::all();

        foreach ($categories as $category) {

            if (!$category->image) continue;

            $oldPath = public_path($category->image);

            if (!file_exists($oldPath)) continue;

            $ext = pathinfo($oldPath, PATHINFO_EXTENSION);

            $baseName = $this->generateSeoName($category->name);

            $newName = $baseName . '.' . $ext;
            $newPath = public_path('uploads/categories/' . $newName);

            $count = 1;
            while (file_exists($newPath)) {
                $newName = $baseName . '-' . $count . '.' . $ext;
                $newPath = public_path('uploads/categories/' . $newName);
                $count++;
            }

            rename($oldPath, $newPath);

            $category->image = 'uploads/categories/' . $newName;
            $category->save();
        }

        return "✅ Category images renamed successfully";
    }
}