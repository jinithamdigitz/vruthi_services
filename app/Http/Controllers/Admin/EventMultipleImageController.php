<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventMultipleImage;

class EventMultipleImageController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|max:2048',
        ]);

        foreach ($request->file('images') as $imageFile) {
            $path = $imageFile->store('event_multiple_images', 'public');
            EventMultipleImage::create([
                'name' => $path,
                'event_id' => $event->id,
            ]);
        }

        return redirect()->back()->with('success', 'Images uploaded successfully!');
    }
}
