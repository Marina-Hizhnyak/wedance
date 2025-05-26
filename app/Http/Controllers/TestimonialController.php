<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TestimonialController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'position' => 'nullable|string|max:255',
            'rating' => 'nullable|integer|min:1|max:5',
            'avatar' => 'nullable|image|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('images/avatars', 'public');
        }

        Testimonial::create([
            'user_id' => auth()->id(),
            'position' => $request->position,
            'avatar' => $path,
            'content' => $request->content,
            'rating' => $request->rating ?? 5,
        ]);

        return redirect()->back()->with('success', 'Votre témoignage a été envoyé !');
    }


    public function update(Request $request, Testimonial $testimonial)
    {

        $request->validate([
            'content' => 'required|string',
            'position' => 'nullable|string|max:255',
            'rating' => 'nullable|integer|min:1|max:5',
            'avatar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('images/avatars', 'public');
            $testimonial->avatar = $path;
        }

        $testimonial->position = $request->position;
        $testimonial->content = $request->content;
        $testimonial->rating = $request->rating ?? 5;

        $testimonial->save();

        return redirect()->back()->with('success', 'Témoignage mis à jour avec succès.');
    }


    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->back()->with('success', 'Témoignage supprimé.');
    }

    public function indexAdmin()
    {
        return Inertia::render('Dashboard/tabs/TestimonialsTab', [
            'testimonials' => Testimonial::with('user')->latest()->get(),
        ]);
    }

    public function updateAdmin(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'content' => 'required|string',
            'position' => 'nullable|string|max:255',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        $testimonial->update($request->only('content', 'position', 'rating'));

        return redirect()->back()->with('success', 'Témoignage mis à jour.');
    }

    public function destroyAdmin(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->back()->with('success', 'Témoignage supprimé.');
    }
}
