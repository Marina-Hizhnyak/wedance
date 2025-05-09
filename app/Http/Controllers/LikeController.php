<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'likeable_type' => 'required|string',
            'likeable_id' => 'required|integer',
        ]);

        $user = Auth::user();

        $like = Like::where('user_id', $user->id)
            ->where('likeable_type', $request->likeable_type)
            ->where('likeable_id', $request->likeable_id)
            ->first();

        if ($like) {
            $like->delete();
        } else {
            $user->likes()->create([
                'likeable_type' => $request->likeable_type,
                'likeable_id' => $request->likeable_id,
            ]);
        }

        return redirect()->back();
    }
}
