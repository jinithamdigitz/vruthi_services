<?php
// app/Http\Controllers/Admin\DonationReportController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DonationReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();
        
        // Date filters
        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        
        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }
        
        // Status filter
        if ($request->has('status') && $request->status) {
            $query->where('order_status', $request->status);
        }

        // Payment status filter
        if ($request->has('payment_status') && $request->payment_status) {
            $query->where('payment_status', $request->payment_status);
        }

        // Donor type filter
        if ($request->has('donor_type') && $request->donor_type) {
            $query->where('donor_type', $request->donor_type);
        }

        // Preferred cause filter
        if ($request->has('preferred_cause') && $request->preferred_cause) {
            $query->where('preferred_cause', $request->preferred_cause);
        }

        $donations = $query->orderBy('created_at', 'desc')->paginate(20);
        
        // Statistics - apply same filters
        $statsQuery = Order::query();
        
        if ($request->has('start_date') && $request->start_date) {
            $statsQuery->whereDate('created_at', '>=', $request->start_date);
        }
        
        if ($request->has('end_date') && $request->end_date) {
            $statsQuery->whereDate('created_at', '<=', $request->end_date);
        }
        
        if ($request->has('status') && $request->status) {
            $statsQuery->where('order_status', $request->status);
        }

        if ($request->has('payment_status') && $request->payment_status) {
            $statsQuery->where('payment_status', $request->payment_status);
        }

        $stats = [
            'totalAmount' => (clone $statsQuery)->where('order_status', 'completed')->sum('amount'),
            'successfulCount' => (clone $statsQuery)->where('order_status', 'completed')->count(),
            'pendingCount' => (clone $statsQuery)->where('order_status', 'pending')->count(),
            'failedCount' => (clone $statsQuery)->where('order_status', 'failed')->count(),
            'todayAmount' => Order::where('order_status', 'completed')
                                ->whereDate('created_at', today())
                                ->sum('amount'),
            'monthAmount' => Order::where('order_status', 'completed')
                                ->whereMonth('created_at', now()->month)
                                ->whereYear('created_at', now()->year)
                                ->sum('amount'),
            // New statistics for money donations
            'moneyDonationsCount' => (clone $statsQuery)->whereNotNull('donor_type')->count(),
            'moneyDonationsAmount' => (clone $statsQuery)->whereNotNull('donor_type')->where('order_status', 'completed')->sum('amount'),
            'gdprConsentCount' => (clone $statsQuery)->where('gdpr_consent', true)->count(),
        ];

        // Donor type statistics
        $donorTypeStats = Order::whereNotNull('donor_type')
            ->where('order_status', 'completed')
            ->selectRaw('donor_type, count(*) as count, sum(amount) as total_amount')
            ->groupBy('donor_type')
            ->get()
            ->pluck('total_amount', 'donor_type');

        // Cause statistics
        $causeStats = Order::whereNotNull('preferred_cause')
            ->where('order_status', 'completed')
            ->selectRaw('preferred_cause, count(*) as count, sum(amount) as total_amount')
            ->groupBy('preferred_cause')
            ->get()
            ->pluck('total_amount', 'preferred_cause');

        return view('admin.donations-report', compact('donations', 'stats', 'donorTypeStats', 'causeStats'));
    }
     public function show($id)
    {
        $donation = Order::findOrFail($id);
        
        return view('admin.donations-show', compact('donation'));
    }

    public function export(Request $request)
    {
        $query = Order::query();
        
        // Apply same filters as index
        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        
        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }
        
        if ($request->has('status') && $request->status) {
            $query->where('order_status', $request->status);
        }

        $donations = $query->orderBy('created_at', 'desc')->get();

        $fileName = 'donations_report_' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $callback = function() use ($donations) {
            $file = fopen('php://output', 'w');
            
            // Add CSV headers with new fields
            fputcsv($file, [
                'ID', 'Donor Name', 'Email', 'Phone', 'Amount', 
                'Order Status', 'Payment Status', 'Donor Type', 'Preferred Cause',
                'GDPR Consent', 'Razorpay Order ID', 'Razorpay Payment ID', 'Message',
                'Address', 'Created Date'
            ]);

            // Add data rows
            foreach ($donations as $donation) {
                fputcsv($file, [
                    $donation->id,
                    $donation->name,
                    $donation->email_id,
                    $donation->phonenumber,
                    $donation->amount,
                    $donation->order_status,
                    $donation->payment_status ?? 'N/A',
                    $donation->donor_type ?? 'N/A',
                    $donation->preferred_cause ?? 'N/A',
                    $donation->gdpr_consent ? 'Yes' : 'No',
                    $donation->razorpay_order_id ?? 'N/A',
                    $donation->razorpay_payment_id ?? 'N/A',
                    $donation->message ?? 'N/A',
                    $donation->address ?? 'N/A',
                    $donation->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}