<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Notifications\NewCourseNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminCourseController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'duration' => 'required|string',
            'day_time' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'instructor_id' => 'nullable|exists:users,id',
            'course_category_id' => 'nullable|exists:course_categories,id',
            'course_level_id' => 'nullable|exists:course_levels,id',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images/courses', 'public');
        }

        $course = Course::create($data);

        User::where('role', 'user')->get()->each(function ($user) use ($course) {
            $user->notify(new NewCourseNotification($course));
        });
        return back()->with('success', 'Cours ajouté.');
    }

    public function update(Request $request, Course $course)
    {
        // dd($request);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'duration' => 'required|string',
            'day_time' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'instructor_id' => 'nullable|exists:users,id',
            'course_category_id' => 'nullable|exists:course_categories,id',
            'course_level_id' => 'nullable|exists:course_levels,id',
        ]);

        if ($request->hasFile('image')) {
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }
            $data['image'] = $request->file('image')->store('images/courses', 'public');
        }

        $course->update($data);

        return back()->with('success', 'Cours mis à jour.');
    }

    public function destroy(Course $course)
    {
        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }

        $course->delete();

        return back()->with('success', 'Cours supprimé.');
    }
}
