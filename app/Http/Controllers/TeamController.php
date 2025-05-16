<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class TeamController extends Controller
{
    public function editOwn()
    {
        $user = auth()->user();
        $profile = $user->teamProfile;

        return Inertia::render('Dashboard/Teacher', [
            'user' => auth()->user(),
            'teamMember' => $profile,
        ]);
    }

    public function updateOwn(Request $request)
    {
        $user = auth()->user();
        $profile = $user->teamProfile;

        $validated = $request->validate([
            'role' => 'required|string',
            'description' => 'required|string',
            'quote' => 'nullable|string',
            'telegram_url' => 'nullable|url',
            'whatsapp_url' => 'nullable|url',
            'vk_url' => 'nullable|url',
        ]);

        $profile->update($validated);

        return redirect()->back()->with('success', 'Profil mis à jour');
    }
}
