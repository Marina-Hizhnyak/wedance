<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
            'course_id' => 'nullable|exists:courses,id',
        ]);

        Message::create($validated);

        return back()->with('success', 'Votre message a été envoyé !');
    }
}
