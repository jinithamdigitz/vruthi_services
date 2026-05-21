<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
     * Store a newly created member in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'slug' => 'nullable|string|max:255|unique:members,slug',
            'keyword' => 'nullable|string',
        ]);

        $member = new Member();
        $member->name = $request->name;
        $member->designation = $request->designation;
        $member->description = $request->description;
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

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/members'), $imageName);
            $member->image = 'uploads/members/' . $imageName;
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
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'slug' => 'nullable|string|max:255|unique:members,slug,' . $id,
        'keyword' => 'nullable|string',
    ]);

    $member = Member::findOrFail($id);
    $member->name = $request->name;
    $member->designation = $request->designation;
    $member->description = $request->description;
    $member->keyword = $request->keyword;

    // Handle slug - only auto-generate if user left it empty
    if ($request->filled('slug')) {
        // User provided a custom slug
        $member->slug = Str::slug($request->slug);
    } else {
        // Auto-generate slug from name (only if user left it blank)
        $member->slug = Str::slug($request->name);
    }

    // Ensure unique slug (exclude current record)
    $originalSlug = $member->slug;
    $count = 1;
    while (Member::where('slug', $member->slug)->where('id', '!=', $member->id)->exists()) {
        $member->slug = $originalSlug . '-' . $count++;
    }

    // Handle image upload
    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($member->image && file_exists(public_path($member->image))) {
            unlink(public_path($member->image));
        }
        
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/members'), $imageName);
        $member->image = 'uploads/members/' . $imageName;
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
}