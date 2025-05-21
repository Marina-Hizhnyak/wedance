<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Event;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        $courses = Course::with(['instructor', 'level', 'category'])
            ->limit(4)
            ->get();

        foreach ($courses as $course) {
            $course->is_registered = $user && $course->users->contains($user->id);
        }
        return Inertia::render('Home/Index', [
            'courses' => $courses,
            'events' => Event::orderBy('date', 'asc')->limit(3)->get(),
            'testimonials' => Testimonial::all(),
            'teams' => TeamMember::with('user')->get(),
        ]);
    }
}
