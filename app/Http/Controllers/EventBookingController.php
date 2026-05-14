<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventBooking; 
class EventBookingController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string',
            'message' => 'nullable|string',
        ]);

        EventBooking::create($validated);

        return response()->json(['message' => 'Booking successful!']);
    }
}
