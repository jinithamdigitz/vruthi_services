<?php
// app/Http/Controllers/Admin/ContactController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the contact submissions.
     */
   public function index(Request $request)
    {
        $query = ContactSubmission::query();
        
        // Search by name
        if ($request->has('name') && $request->name != '') {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        
        // Filter by date range
        if ($request->has('from_date') && $request->from_date != '') {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        
        if ($request->has('to_date') && $request->to_date != '') {
            $query->whereDate('created_at', '<=', $request->to_date);
        }
        
        // Filter by status
        if ($request->has('status') && $request->status != '') {
            if ($request->status == 'read') {
                $query->where('is_read', true);
            } elseif ($request->status == 'unread') {
                $query->where('is_read', false);
            }
        }
        
        $perPage = $request->get('per_page', 10);
        $submissions = $query->orderBy('created_at', 'desc')->paginate($perPage);
        
        // Preserve all query parameters in pagination links
        $submissions->appends($request->except('page'));
        
        return view('admin.contacts.index', compact('submissions'));
    }

    /**
     * Display the specified contact submission.
     */
    public function show(ContactSubmission $contact)
    {
        // Mark as read when viewing
        if (!$contact->is_read) {
            $contact->update(['is_read' => true]);
        }
        
        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Remove the specified contact submission from storage.
     */
    public function destroy(ContactSubmission $contact)
    {
        try {
            $contact->delete();
            return redirect()->route('admin.contacts.index')->with('success', 'Contact submission deleted successfully.');
        } catch (\Exception $e) {
            \Log::error('Error deleting contact submission: ' . $e->getMessage());
            return redirect()->route('admin.contacts.index')->with('error', 'Error deleting contact submission.');
        }
    }

    /**
     * Mark a contact submission as read.
     */
    public function markAsRead(ContactSubmission $contact)
    {
		
		echo "hhh";exit;
        try {
            $contact->update(['is_read' => true]);
            return redirect()->back()->with('success', 'Marked as read.');
        } catch (\Exception $e) {
            \Log::error('Error marking as read: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error marking as read.');
        }
    }

    /**
     * Mark a contact submission as unread.
     */
public function markAsUnread(ContactSubmission $contact)
{
    // Create a detailed log message
    $logMessage = "=== markAsUnread Method Called ===\n";
    $logMessage .= "Time: " . now() . "\n";
    $logMessage .= "Contact ID: " . $contact->id . "\n";
    $logMessage .= "Before - is_read: " . ($contact->is_read ? 'true (1)' : 'false (0)') . "\n";
    $logMessage .= "Raw value: " . $contact->getRawOriginal('is_read') . "\n";

    try {
        // Update using save() method
        $contact->is_read = false;
        $saved = $contact->save();
        
        $logMessage .= "Save result: " . ($saved ? 'SUCCESS' : 'FAILED') . "\n";
        
        // Refresh and check
        $contact->refresh();
        $logMessage .= "After save - is_read: " . ($contact->is_read ? 'true (1)' : 'false (0)') . "\n";
        $logMessage .= "Raw value after: " . $contact->getRawOriginal('is_read') . "\n";
        $logMessage .= "Updated at: " . $contact->updated_at . "\n";

        // Log to a custom file
        file_put_contents(storage_path('logs/contact_debug.log'), $logMessage . "\n\n", FILE_APPEND);

        return redirect()->route('admin.contacts.index')->with('success', 'Marked as unread.');

    } catch (\Exception $e) {
        $errorMessage = $logMessage . "ERROR: " . $e->getMessage() . "\n";
        file_put_contents(storage_path('logs/contact_debug.log'), $errorMessage . "\n\n", FILE_APPEND);
        
        return redirect()->back()->with('error', 'Error marking as unread.');
    }
}

    /**
     * Show unread contact submissions.
     */
    public function unread()
    {
        $submissions = ContactSubmission::where('is_read', false)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.contacts.unread', compact('submissions'));
    }

    /**
     * Bulk actions for contact submissions.
     */
    public function bulkAction(Request $request)
    {
        $action = $request->input('action');
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return redirect()->back()->with('error', 'No items selected.');
        }

        try {
            switch ($action) {
                case 'mark_read':
                    ContactSubmission::whereIn('id', $ids)->update(['is_read' => true]);
                    $message = 'Selected items marked as read.';
                    break;
                    
                case 'mark_unread':
                    ContactSubmission::whereIn('id', $ids)->update(['is_read' => false]);
                    $message = 'Selected items marked as unread.';
                    break;
                    
                case 'delete':
                    ContactSubmission::whereIn('id', $ids)->delete();
                    $message = 'Selected items deleted successfully.';
                    break;
                    
                default:
                    return redirect()->back()->with('error', 'Invalid action.');
            }
            
            return redirect()->back()->with('success', $message);
            
        } catch (\Exception $e) {
            \Log::error('Bulk action error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error performing bulk action.');
        }
    }
}