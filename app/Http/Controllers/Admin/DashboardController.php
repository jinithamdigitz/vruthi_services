<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OurProduct;
use App\Models\Post;
use App\Models\User;
use App\Models\PostCategory;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPosts = Post::count();
        $totalUsers = User::count();
        $totalCategories = PostCategory::count();
        $totalProducts = OurProduct::count();
        
        return view('admin.dashboard', compact(
            'totalPosts', 
            'totalUsers', 
            'totalCategories',
            'totalProducts'
        ));
    }


    /**
     * Get dashboard stats for AJAX requests
     */
    public function getStats(Request $request)
    {
        $type = $request->get('type', 'today');
        
        switch ($type) {
            case 'weekly':
                $startDate = Carbon::now()->startOfWeek();
                $endDate = Carbon::now()->endOfWeek();
                $amount = Order::where('order_status', 'completed')
                             ->whereBetween('created_at', [$startDate, $endDate])
                             ->sum('amount');
                $count = Order::where('order_status', 'completed')
                            ->whereBetween('created_at', [$startDate, $endDate])
                            ->count();
                break;
                
            case 'monthly':
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
                $amount = Order::where('order_status', 'completed')
                             ->whereBetween('created_at', [$startDate, $endDate])
                             ->sum('amount');
                $count = Order::where('order_status', 'completed')
                            ->whereBetween('created_at', [$startDate, $endDate])
                            ->count();
                break;
                
            case 'today':
            default:
                $amount = Order::where('order_status', 'completed')
                             ->whereDate('created_at', today())
                             ->sum('amount');
                $count = Order::where('order_status', 'completed')
                            ->whereDate('created_at', today())
                            ->count();
                break;
        }
        
        return response()->json([
            'amount' => $amount,
            'count' => $count,
            'formatted_amount' => '₹' . number_format($amount, 2)
        ]);
    }

    /**
     * Get donation status distribution
     */
   
    /**
     * Get recent activity
     */
    public function getRecentActivity()
    {
        $recentDonations = Order::orderBy('created_at', 'desc')
                              ->limit(5)
                              ->get()
                              ->map(function ($donation) {
                                  return [
                                      'id' => $donation->id,
                                      'donor_name' => $donation->name ?? 'Anonymous',
                                      'amount' => '₹' . number_format($donation->amount, 2),
                                      'status' => $donation->order_status,
                                      'time' => $donation->created_at->diffForHumans(),
                                  ];
                              });
        
        $newUsers = User::orderBy('created_at', 'desc')
                       ->limit(3)
                       ->get()
                       ->map(function ($user) {
                           return [
                               'name' => $user->name,
                               'email' => $user->email,
                               'time' => $user->created_at->diffForHumans(),
                               'type' => 'user_registration'
                           ];
                       });
        
        $activity = $recentDonations->merge($newUsers)->sortByDesc(function ($item) {
            return isset($item['time']) ? $item['time'] : null;
        })->values()->take(8);
        
        return response()->json($activity);
    }
}