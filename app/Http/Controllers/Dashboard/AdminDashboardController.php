<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\ChatSession;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseLevel;
use App\Models\Event;
use App\Models\GalleryMedia;
use App\Models\Message;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $courses = Course::with(['instructor', 'category', 'level'])->get();
        $chats = ChatSession::with(['user', 'messages'])->get();
        return Inertia::render('Dashboard/Admin', [
            'user' => Auth::user(),
            'users' => User::select('id', 'name', 'role', 'email', 'created_at')->get(),
            'courses' => $courses,
            'teachers' => User::where('role', 'teacher')->get(),
            'categories' => CourseCategory::all(),
            'levels' => CourseLevel::all(),
            'events' => Event::with('organizer')->get(),
            'organizers' => User::select('id', 'name')->get(),
            'media' => GalleryMedia::latest()->get(),
            'posts' => BlogPost::with('author')->oldest()->get(),
            'messages' => Message::with('course')->latest()->get(),
            'chats' => $chats,
            'teamMembers' => TeamMember::with('user')->get(),
            'testimonials' => Testimonial::with('user')->get(),
        ]);
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->withErrors(['error' => 'Vous ne pouvez pas vous supprimer vous-même.']);
        }

        $user->delete();

        return back()->with('success', 'Utilisateur supprimé.');
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'role' => ['required', 'in:user,teacher,admin'],
        ]);

        $user->update($validated);

        return redirect()->back()->with('success', 'Utilisateur mis à jour.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:user,teacher,admin',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->back()->with('success', 'Utilisateur créé avec succès.');
    }
}
