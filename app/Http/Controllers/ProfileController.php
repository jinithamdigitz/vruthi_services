<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class ProfileController extends Controller
{
    /**
     * Display user profile with donation reports
     */
   

    /**
     * Show profile edit form
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile_edit', compact('user'));
    }

    /**
     * Update user profile
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'profile_image' => 'nullable|image|max:2048',
            'cover_image' => 'nullable|image|max:4096',
            'gallery_images.*' => 'nullable|image|max:4096',
        ]);

        $user->name = $validated['name'];
        $user->location = $validated['location'] ?? $user->location;
        $user->description = $validated['description'] ?? $user->description;

        // === Profile Image ===
        if ($request->hasFile('profile_image')) {
            if ($user->profile_image && file_exists(public_path($user->profile_image))) {
                unlink(public_path($user->profile_image));
            }

            $file = $request->file('profile_image');
            $filename = time() . '_profile_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profiles'), $filename);
            $user->profile_image = 'uploads/profiles/' . $filename;
        }

        // === Cover Image ===
        if ($request->hasFile('cover_image')) {
            if ($user->cover_image && file_exists(public_path($user->cover_image))) {
                unlink(public_path($user->cover_image));
            }

            $file = $request->file('cover_image');
            $filename = time() . '_cover_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/covers'), $filename);
            $user->cover_image = 'uploads/covers/' . $filename;
        }

        // === Gallery Images ===
        if ($request->hasFile('gallery_images')) {
            $galleryPaths = [];

            // Delete old gallery images if you want to replace them
            if (!empty($user->gallery_images)) {
                $oldGallery = is_array($user->gallery_images)
                    ? $user->gallery_images
                    : json_decode($user->gallery_images, true);
                foreach ($oldGallery as $img) {
                    if (file_exists(public_path($img))) {
                        unlink(public_path($img));
                    }
                }
            }

            foreach ($request->file('gallery_images') as $file) {
                $filename = time() . '_gallery_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/gallery'), $filename);
                $galleryPaths[] = 'uploads/gallery/' . $filename;
            }

            $user->gallery_images = json_encode($galleryPaths);
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }

    /**
     * Show user profile (alias for index)
     */
    public function show()
    {
        return $this->index();
    }
      public function index()
    {
        $user = Auth::user();
        
        $donations = Order::where('email_id', $user->email)
            ->orderBy('created_at', 'desc')
            ->get();

        $stats = [
            'totalDonations' => $donations->where('order_status', 'completed')->sum('amount') ?? 0,
            'successfulDonations' => $donations->where('order_status', 'completed')->count(),
            'thisMonthDonations' => $donations->where('order_status', 'completed')
                ->where('created_at', '>=', now()->startOfMonth())
                ->count(),
        ];

        return view('profile', array_merge($stats, ['user' => $user]));
    }

    /**
     * Display donation reports with filters and pagination
     */
    public function reports(Request $request)
    {
        $user = Auth::user();
        
        // Start with base query
        $query = Order::where('email_id', $user->email);

        // Apply date filters
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Apply status filter
        if ($request->filled('status')) {
            $query->where('order_status', $request->status);
        }

        // Get paginated results
        $donations = $query->orderBy('created_at', 'desc')->paginate(10);

        // Calculate statistics
        $stats = [
            'totalAmount' => $query->where('order_status', 'completed')->sum('amount') ?? 0,
            'totalDonations' => $query->count(),
            'filteredCount' => $donations->count(),
            'successfulCount' => $query->where('order_status', 'completed')->count(),
            'donations' => $donations
        ];

        return view('reports', array_merge($stats, ['user' => $user]));
    }
}