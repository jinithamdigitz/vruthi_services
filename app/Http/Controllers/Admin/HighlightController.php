<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Highlight;
use Illuminate\Http\Request;

class HighlightController extends Controller
{
    public function index()
    {
        $highlights = Highlight::all();
        return view('admin.highlights.index', compact('highlights'));
    }

    public function create()
    {
        return view('admin.highlights.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:250',
            'description' => 'nullable|max:2500',
            'image' => 'nullable|image|max:2048'
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('highlights', 'public');
        }
        Highlight::create($data);
        return redirect()->route('admin.highlights.index')->with('success', 'Highlight created!');
    }

    public function show(Highlight $highlight)
    {
        return view('admin.highlights.show', compact('highlight'));
    }

    public function edit(Highlight $highlight)
    {
        return view('admin.highlights.edit', compact('highlight'));
    }

    public function update(Request $request, Highlight $highlight)
    {
        $data = $request->validate([
            'title' => 'required|max:250',
            'description' => 'nullable|max:2500',
            'image' => 'nullable|image|max:2048'
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('highlights', 'public');
        }
        $highlight->update($data);
        return redirect()->route('admin.highlights.index')->with('success', 'Highlight updated!');
    }

    public function destroy(Highlight $highlight)
    {
        $highlight->delete();
        return redirect()->route('admin.highlights.index')->with('success', 'Highlight deleted!');
    }
}
