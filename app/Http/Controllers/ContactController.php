<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use App\Models\PostCategory;
use App\Models\Post;

class ContactController extends Controller
{
    /**
     * Display the public contact page.
     */
    public function index()
    {
        // Get contact banner
        $category = PostCategory::where('slug', 'contact-banner')->first();
        $contactBanner = $category ? Post::where('post_category_id', $category->id)->first() : null;

        return view('contact', compact('contactBanner'));
    }

    /**
     * Store a new contact message.
     */
    public function submit(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'project_type' => 'nullable|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Save to database
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'project_type' => $request->project_type,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }

    /**
     * Display all contact messages (Admin).
     */
public function adminIndex()
{
    $submissions = Contact::latest()->paginate(20);

    return view('admin.contact-requests.index', compact('submissions'));
}

    /**
     * Display a single contact message (Admin).
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);

        // Mark as read
        if (!$contact->is_read) {
            $contact->update(['is_read' => true]);
        }

        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Delete a contact message (Admin).
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->back()->with('success', 'Contact message deleted successfully!');
    }

    /**
     * Mark message as read (Admin).
     */
    public function markAsRead($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['is_read' => true]);

        return redirect()->back()->with('success', 'Message marked as read!');
    }

    /**
     * Get unread messages count (for admin dashboard).
     */
    public function unreadCount()
    {
        $count = Contact::where('is_read', false)->count();
        return response()->json(['unread_count' => $count]);
    }
}
