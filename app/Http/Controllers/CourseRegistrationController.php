<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseRegistrationController extends Controller
{
    public function store(Course $course)
    {
        // dd($course);
        $user = Auth::user();


        if (!$user->courses->contains($course->id)) {
            $user->courses()->attach($course->id);
        }

        return back()->with('success', 'Vous êtes bien inscrit(e) à ce cours !');
    }


    public function destroy(Course $course)
    {
        $user = Auth::user();
        $user->courses()->detach($course->id);

        return back()->with('success', 'Votre inscription a été annulée.');
    }
}
