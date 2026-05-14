<?php
// app/Http/Controllers/DonationController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\DonationNotification;
use App\Mail\DonorThankYou;

class DonationController extends Controller
{
    private $razorpay;

    public function __construct()
    {
        try {
            if (class_exists('Razorpay\Api\Api')) {
                $this->razorpay = new \Razorpay\Api\Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            } else {
                Log::error('Razorpay SDK not found.');
            }
        } catch (\Exception $e) {
            Log::error('Razorpay initialization failed: ' . $e->getMessage());
        }
    }

    public function showForm()
    {
        return view('donation-form');
    }

    public function createOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string',
            'amount' => 'required|numeric|min:1',
            'phone' => 'required|string|max:15',
            'message' => 'nullable|string'
        ]);

        // Check if Razorpay is available
        if (!$this->razorpay) {
            return response()->json([
                'success' => false,
                'message' => 'Payment service is currently unavailable. Please try again later.'
            ], 503);
        }

        try {
            // Create order in Razorpay
            $razorpayOrder = $this->razorpay->order->create([
                'amount' => $request->amount * 100, // Amount in paise
                'currency' => 'INR',
                'receipt' => 'donation_' . Str::random(10),
                'notes' => [
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'purpose' => 'Donation'
                ]
            ]);

            // Save order to database with 'created' status (not pending)
            $order = Order::create([
                'razorpay_order_id' => $razorpayOrder->id,
                'amount' => $request->amount,
                'name' => $request->name,
                'email_id' => $request->email,
               
                'address' => $request->address,
                'phonenumber' => $request->phone,
                'message' => $request->message // Make sure to save the message
            ]);
			 
			 \Log::info('Order status after create: ' . $order->order_status);
    
    // Update the status
    $order->update(['order_status' => 'created']);
    
    // DEBUG: Check status after update
    $freshOrder = $order->fresh(); // Reload from database
    \Log::info('Order status after update: ' . $freshOrder->order_status);

            return response()->json([
                'success' => true,
                'order_id' => $razorpayOrder->id,
                'amount' => $request->amount,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'key' => env('RAZORPAY_KEY'),
                'callback_url' => route('donation.verify')
            ]);

        } catch (\Exception $e) {
            Log::error('Razorpay Order Creation Failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to create donation order: ' . $e->getMessage()
            ], 500);
        }
    }

    public function verifyPayment(Request $request)
    {
        // Check if Razorpay is available
		
		   \Log::info('=== VERIFY PAYMENT STARTED ===');
    \Log::info('Request data:', $request->all());
        if (!$this->razorpay) {
			 \Log::error('Razorpay not initialized');
            return response()->json([
                'success' => false,
                'message' => 'Payment verification service unavailable.'
            ], 503);
        }

        try {
            $attributes = [
                'razorpay_order_id' => $request->order_id,
                'razorpay_payment_id' => $request->payment_id,
                'razorpay_signature' => $request->signature
            ];
              \Log::info('Verifying signature with attributes:', $attributes);
            $this->razorpay->utility->verifyPaymentSignature($attributes);
               \Log::info('Signature verification PASSED');

            // Payment successful - update order status to 'completed'
            $order = Order::where('razorpay_order_id', $request->order_id)->first();
			  \Log::info('Order found:', [$order ? $order->toArray() : 'Order not found']);
            if ($order) {
                $order->update(['order_status' => 'completed']);
                    \Log::info('Order status updated to completed');
                // Create transaction record
                $transaction = Transaction::create([
                    'from' => $order->email_id,
                    'to' => 'ENVED Foundation',
                    'transaction_code' => $request->payment_id,
                    'amount' => $order->amount
                ]);
  \Log::info('Transaction created:', $transaction->toArray());

                // Send email notifications
                $this->sendEmailNotifications($order, $transaction);
				    \Log::info('Email notifications sent');
            }

            return response()->json([
                'success' => true,
                'message' => 'Payment successful! Thank you for your donation.',
                'payment_id' => $request->payment_id
            ]);

        } catch (\Exception $e) {
            // Payment failed - update order status to 'failed'
            $order = Order::where('id', $request->order_id)->first();
            if ($order) {
                $order->update(['order_status' => 'failed']);
            }

            Log::error('Payment Verification Failed: ' . $e->getMessage());

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

    // Test email functionality
    public function testEmail()
    {
        try {
            $testOrder = Order::first();
            if ($testOrder) {
                $this->sendEmailNotifications($testOrder, null);
                return "Test email sent successfully!";
            }
            return "No orders found to test email.";
        } catch (\Exception $e) {
            return "Email test failed: " . $e->getMessage();
        }
    }
}