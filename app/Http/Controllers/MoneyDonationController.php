<?php
// app/Http/Controllers/MoneyDonationController.php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Razorpay\Api\Api;
use App\Models\Transaction;
use Illuminate\Support\Facades\Mail;
use App\Mail\DonationNotification;
use App\Mail\DonorThankYou;
use Illuminate\Support\Facades\Log;
class MoneyDonationController extends Controller
{
   
    /**
     * Show money donation form
     */
    public function showDonationForm()
    {
        return view('money-donation');
    }

     public function __construct()
    {
        // Check if Razorpay credentials are set
        if (empty(env('RAZORPAY_KEY')) || empty(env('RAZORPAY_SECRET'))) {
            \Log::error('Razorpay credentials not configured');
        } else {
            $this->razorpay = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        }
    }

    /**
     * Create Razorpay order
     */
    public function createOrder(Request $request)
    {
        \Log::info('Money donation order creation started', $request->all());

        // Check if Razorpay is configured
        if (!$this->razorpay) {
            \Log::error('Razorpay not initialized - check credentials');
            return response()->json([
                'success' => false,
                'message' => 'Payment gateway not configured. Please contact support.'
            ], 500);
        }

        // Direct validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'donor_type' => 'required|string|in:Individual/Residential,Association/Education,Institution/Corporate/Commercial,Establishment',
            'amount' => 'required|numeric|min:10', // Minimum ₹10 for Razorpay
            'preferred_cause' => 'required|string|in:Collection Drive,E-Waste Awareness,Sustainability Education Sessions,Educational Institutions',
            'message' => 'nullable|string|max:1000',
            'gdpr_consent' => 'required|accepted'
        ], [
            'amount.min' => 'Donation amount must be at least ₹10.',
        ]);

        if ($validator->fails()) {
            \Log::error('Validation failed', $validator->errors()->toArray());
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            \Log::info('Creating order record in database');

            // Create order record for money donation
            $order = Order::create([
                'name' => $request->name,
                'email_id' => $request->email,
                'phonenumber' => $request->phone,
                'donor_type' => $request->donor_type,
                'amount' => $request->amount,
                'preferred_cause' => $request->preferred_cause,
                'message' => $request->message,
                'gdpr_consent' => (bool) $request->gdpr_consent,
                'order_status' => 'pending',
                'payment_status' => 'pending',
            ]);

            \Log::info('Order record created', ['order_id' => $order->id]);

            // Create Razorpay order
            $orderData = [
                'receipt' => 'DON_' . $order->id,
                'amount' => $request->amount * 100, // Convert to paise
                'currency' => 'INR',
                'payment_capture' => 1
            ];

            \Log::info('Creating Razorpay order', $orderData);

            $razorpayOrder = $this->razorpay->order->create($orderData);

            \Log::info('Razorpay order created', ['razorpay_order_id' => $razorpayOrder['id']]);

            // Update order with Razorpay order ID
            $order->update([
                'razorpay_order_id' => $razorpayOrder['id']
            ]);

            DB::commit();

            \Log::info('Order creation completed successfully');

            return response()->json([
                'success' => true,
                'order_id' => $razorpayOrder['id'],
                'amount' => $request->amount,
                'key' => env('RAZORPAY_KEY'),
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'donation_id' => $order->id
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            \Log::error('Order creation failed: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);

            // Check for specific Razorpay errors
            $errorMessage = 'Order creation failed. Please try again.';
            
            if (str_contains($e->getMessage(), 'Invalid key_id')) {
                $errorMessage = 'Payment gateway configuration error. Please contact support.';
            } elseif (str_contains($e->getMessage(), 'Amount must be at least')) {
                $errorMessage = 'Donation amount must be at least ₹10.';
            }

            return response()->json([
                'success' => false,
                'message' => $errorMessage,
                'debug' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Verify payment and update order
     */
     public function verifyPayment(Request $request)
    {
        \Log::info('=== MONEY DONATION PAYMENT VERIFICATION STARTED ===');
        \Log::info('Request data:', $request->all());

        $validator = Validator::make($request->all(), [
            'razorpay_order_id' => 'required',
            'razorpay_payment_id' => 'required',
            'razorpay_signature' => 'required',
            'donation_id' => 'required|exists:orders,id'
        ]);

        if ($validator->fails()) {
            \Log::error('Payment validation failed', $validator->errors()->toArray());
            return response()->json([
                'success' => false,
                'message' => 'Invalid payment data'
            ], 422);
        }

        try {
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            ];

            \Log::info('Verifying signature with attributes:', $attributes);

            // Verify payment signature
            $this->razorpay->utility->verifyPaymentSignature($attributes);

            \Log::info('Signature verification PASSED');

            // Payment successful - update order status
            $order = Order::find($request->donation_id);
            \Log::info('Order found:', $order ? $order->toArray() : 'Order not found');

            if ($order) {
                DB::beginTransaction();

                // Update order record
                $order->update([
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'razorpay_signature' => $request->razorpay_signature,
                    'payment_status' => 'success',
                    'order_status' => 'completed'
                ]);

                \Log::info('Order status updated to completed');

                // Create transaction record
                $transaction = Transaction::create([
                    'from' => $order->email_id,
                    'to' => 'ENVED Foundation',
                    'transaction_code' => $request->razorpay_payment_id,
                    'amount' => $order->amount,
                    'status' => 'completed',
                    'type' => 'donation',
                    'notes' => json_encode([
                        'donor_name' => $order->name,
                        'donor_type' => $order->donor_type,
                        'preferred_cause' => $order->preferred_cause,
                        'order_id' => $order->id,
                        'razorpay_order_id' => $order->razorpay_order_id
                    ])
                ]);

                \Log::info('Transaction created:', $transaction->toArray());

                DB::commit();

                // Send email notifications
                $this->sendEmailNotifications($order, $transaction);
                \Log::info('Email notifications sent');

                return response()->json([
                    'success' => true,
                    'message' => 'Payment successful! Thank you for your donation.',
                    'payment_id' => $request->razorpay_payment_id,
                    'amount' => $order->amount,
                    'transaction_id' => $transaction->id
                ]);

            } else {
                \Log::error('Order not found for donation_id: ' . $request->donation_id);
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found. Please contact support.'
                ], 404);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            
            \Log::error('Payment verification failed: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);

            // Update order as failed
            if (isset($order)) {
                $order->update([
                    'payment_status' => 'failed',
                    'order_status' => 'failed'
                ]);

                // Create failed transaction record
                try {
                    Transaction::create([
                        'from' => $order->email_id,
                        'to' => 'ENVED Foundation',
                        'transaction_code' => $request->razorpay_payment_id ?? 'failed_' . time(),
                        'amount' => $order->amount,
                        'status' => 'failed',
                        'type' => 'donation',
                        'notes' => json_encode([
                            'donor_name' => $order->name,
                            'error' => $e->getMessage(),
                            'order_id' => $order->id,
                            'razorpay_order_id' => $request->razorpay_order_id
                        ])
                    ]);
                } catch (\Exception $txException) {
                    \Log::error('Failed to create transaction record: ' . $txException->getMessage());
                }
            }

            return response()->json([
                'success' => false,
                'message' => 'Payment verification failed. Please contact support.'
            ], 400);
        }
    }
private function sendEmailNotifications($order, $transaction)
    {
        try {
            // Send thank you email to donor
            Mail::to($order->email_id)->send(new DonorThankYou($order, $transaction));

            // Send notification to admin
            $adminEmail = env('ADMIN_EMAIL');
            if ($adminEmail) {
                Mail::to($adminEmail)->send(new DonationNotification($order, $transaction));
            }

            Log::info('Donation emails sent successfully for order: ' . $order->id);
            
        } catch (\Exception $e) {
            Log::error('Email sending failed: ' . $e->getMessage());
            // Don't throw error, just log it
        }
    }
    /**
     * Admin: List all money donations with filters
     */
    public function index(Request $request)
    {
        $query = Order::moneyDonations();

        // Search filter
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('phone', 'like', '%' . $search . '%')
                  ->orWhere('razorpay_payment_id', 'like', '%' . $search . '%');
            });
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

        // Cause filter
        if ($request->has('cause') && $request->cause) {
            $query->where('preferred_cause', $request->cause);
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
        $totalDonations = Order::moneyDonations()->count();
        $successfulDonations = Order::moneyDonations()->successfulPayments()->count();
        $pendingDonations = Order::moneyDonations()->pending()->count();
        $totalAmount = Order::moneyDonations()->successfulPayments()->sum('amount');
        $thisMonthAmount = Order::moneyDonations()->successfulPayments()
            ->whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->sum('amount');

        return view('admin.money-donations.index', compact(
            'donations', 
            'totalDonations', 
            'successfulDonations', 
            'pendingDonations',
            'totalAmount',
            'thisMonthAmount'
        ));
    }

    /**
     * Admin: Show donation details
     */
    public function show(Order $order)
    {
        // Ensure this is a money donation
        if (!$order->isMoneyDonation()) {
            abort(404, 'Donation not found');
        }

        return view('admin.money-donations.show', compact('order'));
    }

    /**
     * Export donations to CSV
     */
    public function exportDonations()
    {
        $donations = Order::moneyDonations()->get();
        $fileName = 'money_donations_' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $callback = function() use ($donations) {
            $file = fopen('php://output', 'w');
            
            // Add CSV headers
            fputcsv($file, [
                'ID', 'Name', 'Email', 'Phone', 'Donor Type', 
                'Amount', 'Preferred Cause', 'Message', 'Payment Status',
                'Order Status', 'Razorpay Payment ID', 'GDPR Consent', 'Donation Date'
            ]);

            // Add data rows
            foreach ($donations as $donation) {
                fputcsv($file, [
                    $donation->id,
                    $donation->name,
                    $donation->email,
                    $donation->phone,
                    $donation->donor_type,
                    $donation->formatted_amount,
                    $donation->preferred_cause,
                    $donation->message ?? 'N/A',
                    $donation->payment_status,
                    $donation->order_status,
                    $donation->razorpay_payment_id ?? 'N/A',
                    $donation->gdpr_consent ? 'Yes' : 'No',
                    $donation->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Get donation statistics (API endpoint)
     */
    public function getStatistics()
    {
        $totalDonations = Order::moneyDonations()->count();
        $successfulDonations = Order::moneyDonations()->successfulPayments()->count();
        $totalAmount = Order::moneyDonations()->successfulPayments()->sum('amount');
        
        $causeStats = Order::moneyDonations()->successfulPayments()
            ->groupBy('preferred_cause')
            ->selectRaw('preferred_cause, count(*) as count, sum(amount) as total_amount')
            ->get()
            ->mapWithKeys(function($item) {
                return [$item->preferred_cause => [
                    'count' => $item->count,
                    'total_amount' => $item->total_amount
                ]];
            });

        $monthlyStats = Order::moneyDonations()->successfulPayments()
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->selectRaw('MONTH(created_at) as month, count(*) as count, sum(amount) as total_amount')
            ->get()
            ->pluck('total_amount', 'month');

        return response()->json([
            'total_donations' => $totalDonations,
            'successful_donations' => $successfulDonations,
            'total_amount' => $totalAmount,
            'causes' => $causeStats,
            'monthly_stats' => $monthlyStats
        ]);
    }
}