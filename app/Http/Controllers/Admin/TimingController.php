<?php
// app/Http/Controllers/TimingController.php

namespace App\Http\Controllers\Admin;

use App\Models\Timing;
use Illuminate\Http\Request;

class TimingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $timings = Timing::all();
        return view('admin.timings.index', compact('timings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.timings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        Timing::create($request->all());

        return redirect()->route('admin.timings.index')
            ->with('success', 'Timing created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Timing $timing)
    {
        return view('admin.timings.show', compact('timing'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Timing $timing)
    {
        return view('admin.timings.edit', compact('timing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Timing $timing)
    {
        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        $timing->update($request->all());

        return redirect()->route('admin.timings.index')
            ->with('success', 'Timing updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Timing $timing)
    {
        $timing->delete();

        return redirect()->route('admin.timings.index')
            ->with('success', 'Timing deleted successfully.');
    }
}