<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use App\Models\Service;
use Illuminate\Http\Request;
use Gregwar\Captcha\CaptchaBuilder; 

class ContactSubmissionController extends Controller
{
    /**
     * Store contact form submission (Public)
     */
   public function store(Request $request)
{
    try {
        // Get all services to validate against
        $services = Service::all();
        $validServiceSlugs = $services->pluck('slug')->toArray();
        
        if (!in_array('other', $validServiceSlugs)) {
            $validServiceSlugs[] = 'other';
        }

        // ✅ ADD captcha validation here
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'company' => 'nullable|string|max:255',
            'service_interest' => 'required|string|in:' . implode(',', $validServiceSlugs),
            'city' => 'required|string|in:' . implode(',', array_keys(ContactSubmission::getCityOptions())),
            'project_description' => 'required|string',
            'captcha' => 'required' // 👈 NEW
        ]);

        // ✅ CAPTCHA CHECK
        if (!CaptchaController::check($request->captcha)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid CAPTCHA',
                'errors' => [
                    'captcha' => ['Incorrect CAPTCHA entered']
                ]
            ], 422);
        }

        // ✅ Clear captcha after success
        session()->forget('captcha_code');

        // Store in database
        $submission = ContactSubmission::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for contacting Zoom Innovation! We will get back to you within 24 hours.'
        ]);

    } catch (\Exception $e) {

        if ($e instanceof \Illuminate\Validation\ValidationException) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }

        return response()->json([
            'success' => false,
            'message' => 'An error occurred. Please try again later.'
        ], 500);
    }
}
    /**
     * Display listing of submissions (Admin)
     */
    public function index(Request $request)
    {
        $query = ContactSubmission::query();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('service_interest', 'like', "%{$search}%")
                  ->orWhere('service_name', 'like', "%{$search}%");
            });
        }

        // Filter by service
        if ($request->has('service') && $request->service) {
            $query->where('service_interest', $request->service);
        }

        // Sort by latest first
        $submissions = $query->orderBy('created_at', 'desc')->paginate(15);
        
        // Get all services for filter dropdown in admin
        $services = Service::orderBy('title')->get();
        
        // Get statistics
        $totalSubmissions = ContactSubmission::count();
        $todaySubmissions = ContactSubmission::whereDate('created_at', today())->count();
        
        return view('admin.contact.index', compact(
            'submissions', 
            'services', 
            'totalSubmissions', 
            'todaySubmissions'
        ));
    }

    /**
     * Show single submission (Admin)
     */
    public function show($id)
    {
        $submission = ContactSubmission::findOrFail($id);
        
        // Get the service details if available
        $service = null;
        if ($submission->service_interest && $submission->service_interest !== 'other') {
            $service = Service::where('slug', $submission->service_interest)->first();
        }
        
        return view('admin.contact.show', compact('submission', 'service'));
    }

    /**
     * Delete submission (Admin)
     */
    public function destroy($id)
    {
        $submission = ContactSubmission::findOrFail($id);
        $submission->delete();

        return redirect()->route('admin.contact.index')
            ->with('success', 'Submission deleted successfully');
    }

    /**
     * Bulk delete submissions (Admin)
     */
    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:contact_submissions,id'
        ]);

        ContactSubmission::whereIn('id', $request->ids)->delete();

        return redirect()->route('admin.contact.index')
            ->with('success', 'Selected submissions deleted successfully');
    }

    /**
     * Export submissions (Admin)
     */
    public function export(Request $request)
    {
        $query = ContactSubmission::query();
        
        if ($request->has('service') && $request->service) {
            $query->where('service_interest', $request->service);
        }
        
        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        $submissions = $query->orderBy('created_at', 'desc')->get();
        
        // Create CSV export
        $fileName = 'contact-submissions-' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];
        
        $callback = function() use ($submissions) {
            $file = fopen('php://output', 'w');
            
            // Add headers
            fputcsv($file, [
                'ID', 
                'Full Name', 
                'Email', 
                'Phone', 
                'Company', 
                'Service', 
                'Service Name',
                'City', 
                'Project Description', 
                'Submitted At'
            ]);
            
            // Add data
            foreach ($submissions as $submission) {
                fputcsv($file, [
                    $submission->id,
                    $submission->full_name,
                    $submission->email,
                    $submission->phone,
                    $submission->company,
                    $submission->service_interest,
                    $submission->service_name,
                    $submission->city,
                    $submission->project_description,
                    $submission->created_at->format('Y-m-d H:i:s')
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
}