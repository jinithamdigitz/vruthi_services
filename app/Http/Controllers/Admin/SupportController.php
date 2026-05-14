<?php
// app/Http/Controllers/Admin/SupportController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportMessage;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    /**
     * Display a listing of support messages.
     */
     public function index(Request $request)
    {
        $query = SupportMessage::query();

        // Search filter
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Date range filter
        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Sort filter
        $sort = $request->get('sort', 'newest');
        if ($sort == 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc'); // default: newest first
        }

        $messages = $query->paginate(10)->withQueryString();

        return view('admin.support.index', compact('messages'));
    }

    /**
     * Display the specified support message.
     */
    public function show(SupportMessage $support)
    {
        return view('admin.support.show', compact('support'));
    }

    /**
     * Show the form for editing the support message.
     */
    public function edit(SupportMessage $support)
    {
        return view('admin.support.edit', compact('support'));
    }

    /**
     * Update the specified support message.
     */
    public function update(Request $request, SupportMessage $support)
    {
        $request->validate([
            'status' => 'required|in:new,in_progress,resolved,closed',
            'admin_notes' => 'nullable|string'
        ]);

        $support->update($request->only(['status', 'admin_notes']));

        return redirect()->route('admin.support.index')
            ->with('success', 'Support message updated successfully.');
    }

    /**
     * Remove the specified support message.
     */
    public function destroy(SupportMessage $support)
    {
        $support->delete();

        return redirect()->route('admin.support.index')
            ->with('success', 'Support message deleted successfully.');
    }

    /**
     * Get support statistics for dashboard
     */
    public function stats()
    {
        $total = SupportMessage::count();
        $new = SupportMessage::where('status', 'new')->count();
        $resolved = SupportMessage::where('status', 'resolved')->count();

        return response()->json([
            'total' => $total,
            'new' => $new,
            'resolved' => $resolved
        ]);
    }
}