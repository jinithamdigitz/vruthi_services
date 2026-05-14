<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolarCalculator;

class SolarCalculatorController extends Controller
{
    public function index()
    {
        return view('calculator');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'contact_number' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'daily_consumption' => 'required|integer|min:1|max:50',
            'monthly_bill' => 'required|integer|min:100|max:10000',
            'system_type' => 'required|in:on_grid,off_grid,hybrid',
        ]);

        $monthlyBill = $request->monthly_bill;

        $savingPercent = match ($request->system_type) {
            'on_grid' => 0.70,
            'off_grid' => 0.50,
            'hybrid' => 0.80,
            default => 0.70,
        };

        $estimatedSavings = ($monthlyBill * 12) * $savingPercent;

        $record = SolarCalculator::create([
            'name' => $request->name,
            'location' => $request->location,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'daily_consumption' => $request->daily_consumption,
            'monthly_bill' => $request->monthly_bill,
            'system_type' => $request->system_type,
            'estimated_savings' => $estimatedSavings,
        ]);

        // Check if AJAX request
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Solar savings calculated and saved successfully!',
                'data' => $record,
                'estimated_savings' => $estimatedSavings
            ]);
        }

        // For non-AJAX requests (fallback)
        return redirect()->back()
            ->with('success', 'Solar savings calculated and saved successfully!')
            ->with('estimated_savings', $estimatedSavings);
    }

    public function adminList()
    {
        $records = SolarCalculator::latest()->get();
        return view('admin.solar-calculations', compact('records'));
    }
}