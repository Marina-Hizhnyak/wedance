<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
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

    public function updateTeamMemberProfil(Request $request, TeamMember $teamMember)
    {
        $data = $request->validate([
            'role' => 'required|string|max:255',
            'description' => 'required|string',
            'quote' => 'nullable|string|max:255',
            'telegram_url' => 'nullable|url|max:255',
            'whatsapp_url' => 'nullable|url|max:255',
            'vk_url' => 'nullable|url|max:255',
            'user_id' => 'nullable|exists:users,id',
            'photo' => 'nullable|file|image|max:2048',
            'avatar' => 'nullable|file|image|max:2048',
        ]);

        $teamMember->update($data);

        return back()->with('success', 'Profil mis à jour avec succès.');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'role' => 'required|string|max:255',
            'description' => 'required|string',
            'quote' => 'nullable|string|max:255',
            'telegram_url' => 'nullable|url|max:255',
            'whatsapp_url' => 'nullable|url|max:255',
            'vk_url' => 'nullable|url|max:255',
            'user_id' => 'nullable|exists:users,id',
            'photo' => 'nullable|file|image|max:2048',
            'avatar' => 'nullable|file|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        TeamMember::create($data);

        return back()->with('success', 'Membre ajouté avec succès.');
    }


    public function destroy(TeamMember $teamMember)
    {
        $teamMember->delete();

        return back()->with('success', 'Membre supprimé avec succès.');
    }
}
