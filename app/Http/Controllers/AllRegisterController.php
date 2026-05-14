<?php
// app/Http/Controllers/AllRegisterController.php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AllRegisterController extends Controller
{
    /**
     * Show volunteer registration form
     */
    public function showVolunteerForm()
    {
        return view('donationtime'); // Replace with your actual blade file name
    }

    /**
     * Handle volunteer registration with direct validation
     */
   public function registerVolunteer(Request $request)
{
    \Log::info('Volunteer registration started', $request->all());

    // Direct validation rules
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'location' => 'required|string|max:255',
        'preferred_causes' => 'required|array|min:1',
        'preferred_causes.*' => 'string|in:Collection Drive,E-waste Awareness,Educational Sessions,Corporate Events',
        'gdpr_consent' => 'required|accepted'
    ], [
        'name.required' => 'Please enter your full name.',
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address.',
        'phone.required' => 'Please enter your phone number.',
        'location.required' => 'Please enter your preferred location.',
        'preferred_causes.required' => 'Please select at least one preferred cause.',
        'preferred_causes.min' => 'Please select at least one preferred cause.',
        'preferred_causes.*.in' => 'Invalid cause selected.',
        'gdpr_consent.required' => 'You must consent to the processing of your personal data to register as a volunteer.',
        'gdpr_consent.accepted' => 'You must consent to the processing of your personal data to register as a volunteer.',
    ]);

    // Check if validation fails
    if ($validator->fails()) {
        \Log::error('Validation failed', $validator->errors()->toArray());
        return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Please correct the errors below.');
    }

    try {
        DB::beginTransaction();

        \Log::info('Creating volunteer record with data:', [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'location' => $request->location,
            'preferred_causes' => $request->preferred_causes,
            'gdpr_consent' => (bool) $request->gdpr_consent
        ]);

        // Create volunteer record
        $volunteer = Volunteer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'location' => $request->location,
            'preferred_causes' => $request->preferred_causes,
            'gdpr_consent' => (bool) $request->gdpr_consent,
            'status' => 'pending' // Make sure this is included
        ]);

        \Log::info('Volunteer created successfully', ['id' => $volunteer->id]);

        DB::commit();

        return redirect()->back()->with([
            'success' => 'Thank you for registering as a volunteer! We will contact you within 2-3 business days.',
            'volunteer_id' => $volunteer->id
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        
        \Log::error('Volunteer registration failed: ' . $e->getMessage(), [
            'exception' => $e,
            'trace' => $e->getTraceAsString()
        ]);

        return redirect()->back()->with([
            'error' => 'Registration failed. Please try again or contact support.'
        ])->withInput();
    }
}

    /**
     * Admin: List all volunteers
     */
     public function index(Request $request)
    {
        $query = Volunteer::query();

        // Search filter
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('phone', 'like', '%' . $search . '%')
                  ->orWhere('location', 'like', '%' . $search . '%');
            });
        }

        // Status filter
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Cause filter
        if ($request->has('cause') && $request->cause) {
            $query->whereJsonContains('preferred_causes', $request->cause);
        }

        // Date range filter
        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $volunteers = $query->latest()->paginate(20);

        // Statistics
        $totalVolunteers = Volunteer::count();
        $pendingVolunteers = Volunteer::pending()->count();
        $approvedVolunteers = Volunteer::approved()->count();
        $thisMonthVolunteers = Volunteer::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->count();

        return view('admin.volunteers.index', compact(
            'volunteers', 
            'totalVolunteers', 
            'pendingVolunteers', 
            'approvedVolunteers', 
            'thisMonthVolunteers'
        ));
    }

    /**
     * Admin: Show volunteer details
     */
    public function show(Volunteer $volunteer)
    {
        return view('admin.volunteers.show', compact('volunteer'));
    }

    /**
     * Admin: Update volunteer status
     */
    public function updateStatus(Request $request, Volunteer $volunteer)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,approved,rejected'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Invalid status value.');
        }

        $volunteer->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Volunteer status updated successfully.');
    }

    /**
     * Export volunteers to CSV
     */
    public function exportVolunteers()
    {
        $volunteers = Volunteer::all();
        $fileName = 'volunteers_' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $callback = function() use ($volunteers) {
            $file = fopen('php://output', 'w');
            
            // Add CSV headers
            fputcsv($file, [
                'ID', 'Name', 'Email', 'Phone', 'Location', 
                'Preferred Causes', 'Availability', 'Status',
                'Registered Date', 'GDPR Consent', 'Marketing Consent'
            ]);

            // Add data rows
            foreach ($volunteers as $volunteer) {
                fputcsv($file, [
                    $volunteer->id,
                    $volunteer->name,
                    $volunteer->email,
                    $volunteer->phone,
                    $volunteer->location,
                    $volunteer->preferred_causes_formatted,
                    $volunteer->availability,
                    $volunteer->status,
                    $volunteer->created_at->format('Y-m-d H:i:s'),
                    $volunteer->gdpr_consent ? 'Yes' : 'No',
                    $volunteer->marketing_consent ? 'Yes' : 'No',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Get volunteer statistics (API endpoint)
     */
    public function getStatistics()
    {
        $totalVolunteers = Volunteer::count();
        $pendingVolunteers = Volunteer::pending()->count();
        $approvedVolunteers = Volunteer::approved()->count();
        
        $causeStats = DB::table('volunteers')
            ->select(DB::raw('JSON_UNQUOTE(JSON_EXTRACT(preferred_causes, "$[*]")) as cause'))
            ->get()
            ->flatMap(function($item) {
                return json_decode($item->cause);
            })
            ->groupBy(function($cause) {
                return $cause;
            })
            ->map(function($group) {
                return $group->count();
            });

        return response()->json([
            'total' => $totalVolunteers,
            'pending' => $pendingVolunteers,
            'approved' => $approvedVolunteers,
            'causes' => $causeStats
        ]);
    }

    /**
     * Delete volunteer (Admin only)
     */
    public function destroy(Volunteer $volunteer)
    {
        try {
            $volunteer->delete();
            return redirect()->route('admin.volunteers.index')->with('success', 'Volunteer deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete volunteer.');
        }
    }
}