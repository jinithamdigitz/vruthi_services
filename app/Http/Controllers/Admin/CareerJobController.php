<?php
// app/Http/Controllers/CareerJobController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CareerJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CareerJobController extends Controller
{
    public function index(Request $request)
    {
        $query = CareerJob::query();

        // Filter by title
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_date', '<=', $request->date_to);
        }

        // Filter by status
        if ($request->filled('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter by employment type
        if ($request->filled('employment_type')) {
            $query->where('employment_type', $request->employment_type);
        }

        $careerJobs = $query->orderBy('created_date', 'desc')->paginate(10);
        
        return view('admin.career-jobs.index', compact('careerJobs'));
    }

    public function create()
    {
        return view('admin.career-jobs.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'employment_type' => 'required|in:full-time,part-time,contract,freelance,internship',
            'experience' => 'required|integer|min:0|max:50',
            'short_description' => 'required|string|max:500',
            'description' => 'required|string',
            'status' => 'boolean',
            'created_date' => 'required|date'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        CareerJob::create($request->all());

        return redirect()->route('career-jobs.index')
            ->with('success', 'Career job created successfully!');
    }

    public function show(CareerJob $careerJob)
    {
        return view('admin.career-jobs.show', compact('careerJob'));
    }

    public function edit(CareerJob $careerJob)
    {
        return view('admin.career-jobs.edit', compact('careerJob'));
    }

    public function update(Request $request, CareerJob $careerJob)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'employment_type' => 'required|in:full-time,part-time,contract,freelance,internship',
            'experience' => 'required|integer|min:0|max:50',
            'short_description' => 'required|string|max:500',
            'description' => 'required|string',
            'status' => 'boolean',
            'created_date' => 'required|date'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $careerJob->update($request->all());

        return redirect()->route('career-jobs.index')
            ->with('success', 'Career job updated successfully!');
    }

    public function destroy(CareerJob $careerJob)
    {
        $careerJob->delete();
        
        return redirect()->route('career-jobs.index')
            ->with('success', 'Career job deleted successfully!');
    }
}