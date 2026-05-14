<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventMultipleImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// ...namespace and use statements...

class EventController extends Controller
{
    public function index()
    
    {
        $events = Event::all();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:250',
            'description' => 'nullable|string|max:2500',
            'image' => 'nullable|image|max:2048',
            'created_date' => 'nullable|date',
            'multiple_images.*' => 'image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('event_images', 'public');
            $validated['image'] = $path;
        }

        $event = Event::create($validated);

        if ($request->hasFile('multiple_images')) {
            foreach ($request->file('multiple_images') as $file) {
                $filePath = $file->store('event_multiple_images', 'public');
                EventMultipleImage::create([
                    'name' => $filePath,
                    'event_id' => $event->id,
                ]);
            }
        }

        return redirect()->route('admin.events.index')->with('success', 'Event created!');
    }

    public function show($id)
    {
        $event = Event::with('multipleImages')->findOrFail($id);
        return view('admin.events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:250',
            'description' => 'nullable|string|max:2500',
            'image' => 'nullable|image|max:2048',
            'created_date' => 'nullable|date',
            'multiple_images.*' => 'image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($event->image && Storage::disk('public')->exists($event->image)) {
                Storage::disk('public')->delete($event->image);
            }
            $path = $request->file('image')->store('event_images', 'public');
            $validated['image'] = $path;
        }

        $event->update($validated);

        if ($request->hasFile('multiple_images')) {
            foreach ($request->file('multiple_images') as $file) {
                $filePath = $file->store('event_multiple_images', 'public');
                EventMultipleImage::create([
                    'name' => $filePath,
                    'event_id' => $event->id,
                ]);
            }
        }

        return redirect()->route('admin.events.index')->with('success', 'Event updated!');
    }

    public function destroy(Event $event)
    {
        if ($event->image && Storage::disk('public')->exists($event->image)) {
            Storage::disk('public')->delete($event->image);
        }

        foreach ($event->multipleImages as $multipleImage) {
            if (Storage::disk('public')->exists($multipleImage->name)) {
                Storage::disk('public')->delete($multipleImage->name);
            }
            $multipleImage->delete();
        }

        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event deleted!');
    }
}
    
