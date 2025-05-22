<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseLevel;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Support\Str;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $courses = $user->teacherCourses()->with(['instructor', 'category', 'level'])->get();
        $events = $user->teacherEvents()->with('organizer')->latest()->get();
        $user = auth()->user();
        $profile = $user->teamProfile;
        return Inertia::render('Dashboard/Teacher', [
            'user' => $user,
            'courses' => $courses,
            'events' => $events,
            'categories' => CourseCategory::all(),
            'levels' => CourseLevel::all(),
            'teamMember' => $profile,
        ]);
    }

    public function storeCourse(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'duration' => 'required|string',
            'day_time' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'course_category_id' => 'nullable|exists:course_categories,id',
            'course_level_id' => 'nullable|exists:course_levels,id',
        ]);

        // ✅ Always assign current teacher as instructor
        $data['instructor_id'] = Auth::id();

        // ✅ Save image if uploaded
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        Course::create($data);

        return back()->with('success', 'Cours ajouté avec succès.');
    }

    // ✅ Teacher updates only own course
    public function updateCourse(Request $request, Course $course)
    {
        // ✅ Protect: allow only own courses
        if ($course->instructor_id !== Auth::id()) {
            abort(403, 'Vous ne pouvez pas modifier ce cours.');
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'duration' => 'required|string',
            'day_time' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'course_category_id' => 'nullable|exists:course_categories,id',
            'course_level_id' => 'nullable|exists:course_levels,id',
        ]);

        // ✅ Replace image if new uploaded
        if ($request->hasFile('image')) {
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        $course->update($data);

        return back()->with('success', 'Cours mis à jour.');
    }

    // ✅ Teacher deletes only own course
    public function destroyCourse(Course $course)
    {
        if ($course->instructor_id !== Auth::id()) {
            abort(403, 'Vous ne pouvez pas supprimer ce cours.');
        }

        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }

        $course->delete();

        return back()->with('success', 'Cours supprimé.');
    }

    // ✅ Teacher creates own event
    public function storeEvent(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        // ✅ Always assign current teacher as organizer
        $data['organizer_id'] = Auth::id();

        // ✅ Save image if uploaded
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }
        $data['slug'] = Str::slug($data['title']);
        Event::create($data);

        return back()->with('success', 'Événement ajouté avec succès.');
    }

    // ✅ Teacher updates only own event
    public function updateEvent(Request $request, Event $event)
    {
        if ($event->organizer_id !== Auth::id()) {
            abort(403, 'Vous ne pouvez pas modifier cet événement.');
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        $event->update($data);

        return back()->with('success', 'Événement mis à jour.');
    }

    // ✅ Teacher deletes only own event
    public function destroyEvent(Event $event)
    {
        if ($event->organizer_id !== Auth::id()) {
            abort(403, 'Vous ne pouvez pas supprimer cet événement.');
        }

        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return back()->with('success', 'Événement supprimé.');
    }
}
