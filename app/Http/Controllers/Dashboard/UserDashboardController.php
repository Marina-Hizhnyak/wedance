<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ChatSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user->load('testimonials');
        $courses = $user->courses()->with('level', 'category')->get();
        $favorites = Auth::user()->likes()->with('likeable')->latest()->get();
        $chats = Auth::user()->chatSessions()->with('messages')->withCount('messages')->latest()->get();

        return Inertia::render('Dashboard/User', [
            'user' => $user,
            'courses' => $courses,
            'favorites' => $favorites,
            'chats' => $chats,
        ]);
    }

    public function destroy(ChatSession $chatSession)
    {
        if ($chatSession->user_id !== Auth::id()) {
            abort(403);
        }

        $chatSession->messages()->delete();
        $chatSession->delete();

        return back()->with('success', 'Chat session deleted.');
    }
}
