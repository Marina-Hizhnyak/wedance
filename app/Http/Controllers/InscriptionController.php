<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InscriptionController extends Controller
{
    public function index()
    {
        $courses = Course::orderBy('title')->get(['id', 'title']);

        return Inertia::render('Inscription', [
            'courses' => $courses,
        ]);
    }
}
