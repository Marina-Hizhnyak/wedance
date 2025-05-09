<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $courses = $user->courses()->with('level', 'category')->get();

        return Inertia::render('Dashboard/User', [
            'user' => $user,
            'courses' => $courses,
        ]);
    }
}
