<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CourseController extends Controller
{
    public function byCategory($categorySlug)
    {
        $user = Auth::user();

        $category = CourseCategory::where('slug', $categorySlug)->firstOrFail();

        $courses = Course::with(['level', 'category', 'users']) // 👈 users — обязательно
            ->where('course_category_id', $category->id)
            ->get();

        // Добавляем is_registered на каждый курс
        foreach ($courses as $course) {
            $course->is_registered = $user && $course->users->contains($user->id);
        }

        return Inertia::render('Courses/Index', [
            'courses' => $courses,
            'category' => $category->name,
        ]);
    }

    public function byCategoryAndLevel($categorySlug, $levelSlug)
    {
        $user = Auth::user();

        $category = CourseCategory::where('slug', $categorySlug)->firstOrFail();
        $level = CourseLevel::where('slug', $levelSlug)->firstOrFail();

        $courses = Course::with(['level', 'category', 'users'])
            ->where('course_category_id', $category->id)
            ->where('course_level_id', $level->id)
            ->get();

        foreach ($courses as $course) {
            $course->is_registered = $user && $course->users->contains($user->id);
        }

        return Inertia::render('Courses/Index', [
            'courses' => $courses,
            'category' => $category->name,
            'level' => $level->name,
        ]);
    }
}
