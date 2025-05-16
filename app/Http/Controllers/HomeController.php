<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Event;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Home/Index', [
            'courses' => Course::limit(4)->get(),
            'events' => Event::orderBy('date', 'asc')->limit(3)->get(),
            'testimonials' => Testimonial::all(),
            'teams' => TeamMember::with('user')->get(),
        ]);
    }
}
