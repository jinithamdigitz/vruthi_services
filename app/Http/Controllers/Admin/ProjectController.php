<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('category')->latest()->paginate(10);
        $categories = ProjectCategory::all();

        return view('admin.projects.index', compact('projects', 'categories'));
    }

    public function create()
    {
        $categories = ProjectCategory::all();
        return view('admin.projects.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'skills' => 'nullable|string',
            'experience' => 'nullable|string|max:100',
            'project_category_id' => 'required|exists:project_categories,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120'
        ]);

        $data = $request->except(['_token', 'images']);

        $manager = new ImageManager(new Driver());

        // 🔥 MAIN IMAGE (SEO)
        if ($request->hasFile('image')) {
            $data['image'] = $this->compressAndSaveImage(
                $manager,
                $request->file('image'),
                'uploads/projects/',
                $request->name,
                1200,
                100
            );
        }

        $project = Project::create($data);

        // 🔥 GALLERY (SEO)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {

                $imagePath = $this->compressAndSaveImage(
                    $manager,
                    $img,
                    'uploads/projects/',
                    $request->name,
                    800,
                    100
                );

                if ($imagePath) {
                    ProjectImage::create([
                        'project_id' => $project->id,
                        'image' => $imagePath
                    ]);
                }
            }
        }

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        $project->load(['category', 'images']);

        $relatedProjects = Project::where('project_category_id', $project->project_category_id)
            ->where('id', '!=', $project->id)
            ->with('category')
            ->limit(4)
            ->get();

        return view('admin.projects.show', compact('project', 'relatedProjects'));
    }

    public function edit(Project $project)
    {
        $project->load('images');
        $categories = ProjectCategory::all();

        return view('admin.projects.edit', compact('project', 'categories'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'skills' => 'nullable|string',
            'experience' => 'nullable|string|max:100',
            'project_category_id' => 'required|exists:project_categories,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'remove_gallery' => 'nullable|array',
            'remove_gallery.*' => 'exists:project_images,id'
        ]);

        $data = $request->except(['_token', '_method', 'images', 'remove_gallery']);

        $manager = new ImageManager(new Driver());

        // 🔥 MAIN IMAGE UPDATE
        if ($request->hasFile('image')) {

            if ($project->image && file_exists(public_path($project->image))) {
                unlink(public_path($project->image));
            }

            $data['image'] = $this->compressAndSaveImage(
                $manager,
                $request->file('image'),
                'uploads/projects/',
                $request->name,
                1200,
                100
            );
        }

        $project->update($data);

        // REMOVE GALLERY
        if ($request->has('remove_gallery')) {
            foreach ($request->remove_gallery as $id) {
                $img = ProjectImage::find($id);
                if ($img) {
                    if (file_exists(public_path($img->image))) {
                        unlink(public_path($img->image));
                    }
                    $img->delete();
                }
            }
        }

        // ADD NEW GALLERY
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {

                $imagePath = $this->compressAndSaveImage(
                    $manager,
                    $img,
                    'uploads/projects/',
                    $request->name,
                    800,
                    100
                );

                if ($imagePath) {
                    ProjectImage::create([
                        'project_id' => $project->id,
                        'image' => $imagePath
                    ]);
                }
            }
        }

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        if ($project->image && file_exists(public_path($project->image))) {
            unlink(public_path($project->image));
        }

        foreach ($project->images as $img) {
            if ($img->image && file_exists(public_path($img->image))) {
                unlink(public_path($img->image));
            }
            $img->delete();
        }

        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');
    }

    // 🔥 SEO NAME GENERATOR
    private function generateSeoName($name)
    {
        $prefix = 'printing-services-in-kerala';
        $slug = Str::slug(Str::limit($name, 40, ''));

        return $prefix . '-' . $slug;
    }

    // 🔥 IMAGE COMPRESS + SEO SAVE
    private function compressAndSaveImage($manager, $image, $directory, $name, $maxDimension = 1200, $targetSizeKB = 100)
    {
        try {
            $baseName = $this->generateSeoName($name);

            $filename = $baseName . '.webp';
            $relativePath = $directory . $filename;
            $fullPath = public_path($relativePath);

            $count = 1;
            while (file_exists($fullPath)) {
                $filename = $baseName . '-' . $count . '.webp';
                $relativePath = $directory . $filename;
                $fullPath = public_path($relativePath);
                $count++;
            }

            if (!file_exists(public_path($directory))) {
                mkdir(public_path($directory), 0755, true);
            }

            $img = $manager->read($image);

            $img->resize(1200, 1200);

            $img->toWebp(80)->save($fullPath);

            return $relativePath;

        } catch (\Exception $e) {
            \Log::error('Image error: ' . $e->getMessage());
            return null;
        }
    }

    // 🔥 BULK RENAME
    public function renameSeoImages()
    {
        $projects = Project::with('images')->get();

        foreach ($projects as $project) {

            // MAIN IMAGE
            if ($project->image && file_exists(public_path($project->image))) {

                $baseName = $this->generateSeoName($project->name);

                $newName = $baseName . '.webp';
                $newPath = public_path('uploads/projects/' . $newName);

                $count = 1;
                while (file_exists($newPath)) {
                    $newName = $baseName . '-' . $count . '.webp';
                    $newPath = public_path('uploads/projects/' . $newName);
                    $count++;
                }

                rename(public_path($project->image), $newPath);

                $project->image = 'uploads/projects/' . $newName;
                $project->save();
            }

            // GALLERY
            foreach ($project->images as $img) {

                if ($img->image && file_exists(public_path($img->image))) {

                    $baseName = $this->generateSeoName($project->name);

                    $newName = $baseName . '.webp';
                    $newPath = public_path('uploads/projects/' . $newName);

                    $count = 1;
                    while (file_exists($newPath)) {
                        $newName = $baseName . '-' . $count . '.webp';
                        $newPath = public_path('uploads/projects/' . $newName);
                        $count++;
                    }

                    rename(public_path($img->image), $newPath);

                    $img->image = 'uploads/projects/' . $newName;
                    $img->save();
                }
            }
        }

        return "✅ Project images renamed successfully";
    }
}