<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::latest()->with('author')->get();

        return Inertia::render('Blog/Index', [
            'posts' => $posts,
        ]);
    }


    public function show($slug)
    {
        $post = BlogPost::where('slug', $slug)
            ->with(['author', 'comments.user', 'likes'])
            ->firstOrFail();
        return Inertia::render('Blog/Show', [
            'post' => $post,
        ]);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $data['slug'] = Str::slug($data['title']) . '-' . uniqid();
        $data['author_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blog', 'public');
        }

        BlogPost::create($data);

        return redirect()->back();
    }


    public function update(Request $request, BlogPost $post)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blog', 'public');
        }

        $post->update($data);

        return redirect()->back();
    }


    public function destroy(BlogPost $post)
    {
        $post->delete();

        return redirect()->back();
    }
}
