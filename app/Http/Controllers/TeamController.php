<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;


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
            'photo' => 'nullable|image|max:2048',
            'avatar' => 'nullable|image|max:2048',
        ]);


        if ($request->hasFile('photo')) {
            if ($profile->photo && Storage::disk('public')->exists($profile->photo)) {
                Storage::disk('public')->delete($profile->photo);
            }
            $validated['photo'] = $request->file('photo')->store('team_photos', 'public');
        }


        if ($request->hasFile('avatar')) {
            if ($profile->avatar && Storage::disk('public')->exists($profile->avatar)) {
                Storage::disk('public')->delete($profile->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('team_avatars', 'public');
        }

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

    public function storeOwn(Request $request)
    {
        $data = $request->validate([
            'role' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'quote' => 'nullable|string|max:255',
            'telegram_url' => 'nullable|url',
            'whatsapp_url' => 'nullable|url',
            'vk_url' => 'nullable|url',
            'photo' => 'nullable|image|max:2048',
            'avatar' => 'nullable|image|max:2048',
        ]);

        $data['user_id'] = Auth::id();

        // ✅ Gérer les fichiers uploadés
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('team_photos', 'public');
        }

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('team_avatars', 'public');
        }

        TeamMember::create($data);

        return redirect()->back()->with('success', 'Profil créé avec succès.');
    }
}
