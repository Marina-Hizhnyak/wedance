<?php

namespace App\Http\Controllers;

use App\Models\GalleryMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class GalleryMediaController extends Controller
{

    public function index()
    {
        $media = GalleryMedia::latest()->get();

        return Inertia::render('GalleryIndex', [
            'media' => $media,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|max:2048',
            'event_id' => 'nullable|exists:events,id',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images/gallery', 'public');
        }

        GalleryMedia::create($data);

        return redirect()->back();
    }

    public function destroy(GalleryMedia $media)
    {
        Storage::disk('public')->delete($media->image);
        $media->delete();

        return redirect()->back();
    }
}
