<?php
// app/Http/Controllers/EwasteDonationController.php

namespace App\Http\Controllers;

use App\Models\EwasteDonation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EwasteDonationController extends Controller
{
    /**
     * Show e-waste donation form
     */
    public function showDonationForm()
    {
        return view('ewaste-donation');
    }

    /**
     * Handle e-waste donation registration
     */
    public function registerDonation(Request $request)
    {
        \Log::info('E-waste donation started', $request->all());

        // Direct validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'donor_type' => 'required|string|in:Individual/Residential,Association/Education,Institution/Corporate/Commercial,Establishment',
            'pickup_location' => 'required|string|max:500',
            'waste_type' => 'required|string|max:1000',
            'message' => 'nullable|string|max:1000',
            'gdpr_consent' => 'required|accepted'
        ], [
            'name.required' => 'Please enter your full name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'phone.required' => 'Please enter your phone number.',
            'donor_type.required' => 'Please select your category.',
            'pickup_location.required' => 'Please enter the pickup location.',
            'waste_type.required' => 'Please describe what kind of waste you want to donate.',
            'gdpr_consent.required' => 'You must consent to the processing of your personal data.',
            'gdpr_consent.accepted' => 'You must consent to the processing of your personal data.',
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

            \Log::info('Creating e-waste donation record with data:', $request->all());

            // Create donation record
            $donation = EwasteDonation::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'donor_type' => $request->donor_type,
                'pickup_location' => $request->pickup_location,
                'waste_type' => $request->waste_type,
                'message' => $request->message,
                'gdpr_consent' => (bool) $request->gdpr_consent,
                'status' => 'pending',
            ]);

            \Log::info('E-waste donation created successfully', ['id' => $donation->id]);

            DB::commit();

            return redirect()->back()->with([
                'success' => 'Thank you for your e-waste donation request! Our team will contact you within 24 hours to schedule the pickup.',
                'donation_id' => $donation->id
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            \Log::error('E-waste donation registration failed: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with([
                'error' => 'Registration failed. Please try again or contact support.'
            ])->withInput();
        }
    }

    /**
     * Admin: List all e-waste donations with filters
     */
    public function index(Request $request)
    {
        $query = EwasteDonation::query();

        // Search filter
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('phone', 'like', '%' . $search . '%')
                  ->orWhere('pickup_location', 'like', '%' . $search . '%')
                  ->orWhere('waste_type', 'like', '%' . $search . '%');
            });
        }

        // Status filter
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Donor type filter
        if ($request->has('donor_type') && $request->donor_type) {
            $query->where('donor_type', $request->donor_type);
        }

        // Date range filter
        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $donations = $query->latest()->paginate(20);

        // Statistics
        $totalDonations = EwasteDonation::count();
        $pendingDonations = EwasteDonation::pending()->count();
        $scheduledDonations = EwasteDonation::scheduled()->count();
        $completedDonations = EwasteDonation::completed()->count();
        $thisMonthDonations = EwasteDonation::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->count();

        return view('admin.ewaste-donations.index', compact(
            'donations', 
            'totalDonations', 
            'pendingDonations', 
            'scheduledDonations',
            'completedDonations',
            'thisMonthDonations'
        ));
    }

    /**
     * Admin: Show donation details
     */
    public function show(EwasteDonation $ewasteDonation)
    {
        return view('admin.ewaste-donations.show', compact('ewasteDonation'));
    }

    /**
     * Admin: Update donation status
     */
    public function updateStatus(Request $request, EwasteDonation $ewasteDonation)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,approved,scheduled,completed,cancelled'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Invalid status value.');
        }

        $ewasteDonation->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Donation status updated successfully.');
    }

    /**
     * Export donations to CSV
     */
    public function exportDonations()
    {
        $donations = EwasteDonation::all();
        $fileName = 'ewaste_donations_' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $callback = function() use ($donations) {
            $file = fopen('php://output', 'w');
            
            // Add CSV headers
            fputcsv($file, [
                'ID', 'Name', 'Email', 'Phone', 'Donor Type', 
                'Pickup Location', 'Waste Type', 'Message', 'Status',
                'GDPR Consent', 'Created Date'
            ]);

            // Add data rows
            foreach ($donations as $donation) {
                fputcsv($file, [
                    $donation->id,
                    $donation->name,
                    $donation->email,
                    $donation->phone,
                    $donation->donor_type,
                    $donation->pickup_location,
                    $donation->waste_type,
                    $donation->message ?? 'N/A',
                    $donation->status,
                    $donation->gdpr_consent ? 'Yes' : 'No',
                    $donation->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Delete donation (Admin only)
     */
    public function destroy(EwasteDonation $ewasteDonation)
    {
        try {
            $ewasteDonation->delete();
            return redirect()->route('admin.ewaste-donations.index')->with('success', 'Donation deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete donation.');
        }
    }

    /**
     * Get donation statistics (API endpoint)
     */
    public function getStatistics()
    {
        $totalDonations = EwasteDonation::count();
        $pendingDonations = EwasteDonation::pending()->count();
        $scheduledDonations = EwasteDonation::scheduled()->count();
        $completedDonations = EwasteDonation::completed()->count();
        
        $donorTypeStats = EwasteDonation::groupBy('donor_type')
            ->selectRaw('donor_type, count(*) as count')
            ->get()
            ->pluck('count', 'donor_type');

        return response()->json([
            'total' => $totalDonations,
            'pending' => $pendingDonations,
            'scheduled' => $scheduledDonations,
            'completed' => $completedDonations,
            'donor_types' => $donorTypeStats
        ]);
    }
}