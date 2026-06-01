<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class MemberController extends Controller
{
    /**
     * Display a listing of the members.
     */
    public function index()
    {
        $members = Member::orderBy('id', 'desc')->paginate(10);
        return view('admin.members.index', compact('members'));
    }

    /**
     * Show the form for creating a new member.
     */
    public function create()
    {
        return view('admin.members.create');
    }

    /**
     * Compress and convert image to WEBP with SEO-friendly naming
     */
    private function compressAndConvertToWebp($image, $path, $baseName, $width = 800)
    {
        $manager = new ImageManager(new Driver());
        
        // Create directory if not exists
        if (!file_exists(public_path($path))) {
            mkdir(public_path($path), 0777, true);
        }
        
        $img = $manager->read($image->getRealPath());
        
        // Resize if width is greater than specified
        if ($img->width() > $width) {
            $img->scale(width: $width);
        }
        
        // Create filename with .webp extension
        $imageName = $baseName . '.webp';
        $imagePath = public_path($path . '/' . $imageName);
        
        // Handle duplicate files
        $count = 1;
        while (file_exists($imagePath)) {
            $imageName = $baseName . '-' . $count . '.webp';
            $imagePath = public_path($path . '/' . $imageName);
            $count++;
        }
        
        // Compress with quality loop (target ≤100KB)
        $quality = 80;
        do {
            $img->toWebp($quality)->save($imagePath);
            $size = filesize($imagePath) / 1024; // Size in KB
            $quality -= 5;
        } while ($size > 100 && $quality >= 40);
        
        return $path . '/' . $imageName;
    }

    /**
     * Store a newly created member in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'show_html' => 'nullable|in:0,1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'slug' => 'nullable|string|max:255|unique:members,slug',
            'keyword' => 'nullable|string',
        ]);

        $member = new Member();
        $member->name = $request->name;
        $member->designation = $request->designation;
        $member->description = $request->description;
        $member->show_html = $request->has('show_html') ? 1 : 0;
        $member->keyword = $request->keyword;

        // Handle slug - auto generate if not provided
        if ($request->slug) {
            $member->slug = Str::slug($request->slug);
        } else {
            $member->slug = Str::slug($request->name);
        }

        // Ensure unique slug
        $originalSlug = $member->slug;
        $count = 1;
        while (Member::where('slug', $member->slug)->exists()) {
            $member->slug = $originalSlug . '-' . $count++;
        }

        // Handle image upload with compression and WEBP conversion
        if ($request->hasFile('image')) {
            $baseName = Str::slug($member->name);
            $member->image = $this->compressAndConvertToWebp(
                $request->file('image'), 
                'uploads/members', 
                $baseName,
                800
            );
        }

        $member->save();

        return redirect()->route('admin.members.index')
            ->with('success', 'Member created successfully.');
    }

    /**
     * Display the specified member.
     */
    public function show($id)
    {
        $member = Member::findOrFail($id);
        return view('admin.members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified member.
     */
    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view('admin.members.edit', compact('member'));
    }

    /**
     * Update the specified member in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'show_html' => 'nullable|in:0,1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'slug' => 'nullable|string|max:255|unique:members,slug,' . $id,
            'keyword' => 'nullable|string',
        ]);

        $member = Member::findOrFail($id);
        $member->name = $request->name;
        $member->designation = $request->designation;
        $member->description = $request->description;
        $member->show_html = $request->has('show_html') ? 1 : 0;
        $member->keyword = $request->keyword;

        // Handle slug - only auto-generate if user left it empty
        if ($request->filled('slug')) {
            $member->slug = Str::slug($request->slug);
        } else {
            $member->slug = Str::slug($request->name);
        }

        // Ensure unique slug (exclude current record)
        $originalSlug = $member->slug;
        $count = 1;
        while (Member::where('slug', $member->slug)->where('id', '!=', $member->id)->exists()) {
            $member->slug = $originalSlug . '-' . $count++;
        }

        // Handle image upload with compression and WEBP conversion
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($member->image && file_exists(public_path($member->image))) {
                unlink(public_path($member->image));
            }
            
            $baseName = Str::slug($member->name);
            $member->image = $this->compressAndConvertToWebp(
                $request->file('image'), 
                'uploads/members', 
                $baseName,
                800
            );
        }

        $member->save();

        return redirect()->route('admin.members.index')
            ->with('success', 'Member updated successfully.');
    }

    /**
     * Remove the specified member from storage.
     */
    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        
        // Delete image if exists
        if ($member->image && file_exists(public_path($member->image))) {
            unlink(public_path($member->image));
        }
        
        $member->delete();

        return redirect()->route('admin.members.index')
            ->with('success', 'Member deleted successfully.');
    }

    /**
     * Display the specified member by slug (for frontend).
     */
    public function showBySlug($slug)
    {
        $member = Member::where('slug', $slug)->firstOrFail();
        return view('members.show', compact('member'));
    }

    /**
     * Get all members for frontend.
     */
    public function frontendIndex()
    {
        $members = Member::all();
        return view('members.index', compact('members'));
    }

    /**
     * Convert existing member images to WEBP with SEO-friendly naming
     */
    public function convertExistingImagesToWebp()
    {
        $members = Member::whereNotNull('image')->get();
        $manager = new ImageManager(new Driver());
        $converted = 0;
        $failed = 0;
        
        foreach ($members as $member) {
            if (!$member->image || !file_exists(public_path($member->image))) {
                continue;
            }
            
            $oldPath = public_path($member->image);
            $extension = pathinfo($oldPath, PATHINFO_EXTENSION);
            
            // Generate SEO-friendly base name
            $baseName = Str::slug($member->name);
            $newFileName = $baseName . '.webp';
            $newPath = public_path('uploads/members/' . $newFileName);
            
            // Handle duplicates
            $count = 1;
            while (file_exists($newPath)) {
                $newFileName = $baseName . '-' . $count . '.webp';
                $newPath = public_path('uploads/members/' . $newFileName);
                $count++;
            }
            
            try {
                if ($extension === 'webp') {
                    // Just rename if already webp
                    if (copy($oldPath, $newPath)) {
                        unlink($oldPath);
                        $member->image = 'uploads/members/' . $newFileName;
                        $converted++;
                    } else {
                        $failed++;
                    }
                } else {
                    // Convert to webp
                    $img = $manager->read($oldPath);
                    
                    if ($img->width() > 800) {
                        $img->scale(width: 800);
                    }
                    
                    // Compress with quality loop
                    $quality = 80;
                    do {
                        $img->toWebp($quality)->save($newPath);
                        $size = filesize($newPath) / 1024;
                        $quality -= 5;
                    } while ($size > 100 && $quality >= 40);
                    
                    // Delete old image
                    unlink($oldPath);
                    $member->image = 'uploads/members/' . $newFileName;
                    $converted++;
                }
                $member->save();
            } catch (\Exception $e) {
                $failed++;
            }
        }
        
        return response()->json([
            'message' => 'Conversion completed',
            'converted' => $converted,
            'failed' => $failed,
            'total' => $members->count()
        ]);
    }
}