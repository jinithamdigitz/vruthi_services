<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Timeline;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $timelines = Timeline::withoutGlobalScopes()->orderBy('sort_order')->get();
        return view('admin.timelines.index', compact('timelines'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.timelines.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|numeric|min:1900|max:2100',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'icon' => 'required|string|max:255',
        ]);

        $maxSort = Timeline::withoutGlobalScopes()->max('sort_order') ?? 0;
        $validated['sort_order'] = $maxSort + 1;

        Timeline::create($validated);

        return redirect()->route('admin.timelines.index')->with('success', 'Timeline entry created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Timeline $timeline)
    {
        return view('admin.timelines.edit', compact('timeline'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Timeline $timeline)
    {
        $validated = $request->validate([
            'year' => 'required|numeric|min:1900|max:2100',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'icon' => 'required|string|max:255',
        ]);

        $timeline->update($validated);

        return redirect()->route('admin.timelines.index')->with('success', 'Timeline entry updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Timeline $timeline)
    {
        $timeline->delete();
        return redirect()->route('admin.timelines.index')->with('success', 'Timeline entry deleted successfully.');
    }

    /**
     * Update the order of timeline entries.
     */
    public function updateOrder(Request $request)
    {
        $order = $request->input('order', []);

        foreach ($order as $index => $id) {
            Timeline::withoutGlobalScopes()->where('id', $id)->update(['sort_order' => $index + 1]);
        }

        return response()->json(['success' => true, 'message' => 'Order updated successfully.']);
    }
}
