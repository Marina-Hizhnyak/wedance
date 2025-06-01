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
        $posts = BlogPost::oldest()->with('author')->get();

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

    private function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $i = 2;
        while (BlogPost::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $i;
            $i++;
        }
        return $slug;
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $data['slug'] = $this->generateUniqueSlug($data['title']);
        $data['author_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images/blog', 'public');
        }

        BlogPost::create($data);

        return redirect()->back()->with('success', 'L’article a été créé avec succès.');
    }


    public function update(Request $request, BlogPost $post)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images/blog', 'public');
        }

        $post->update($data);

        return redirect()->back()->with('success', 'L’article a été modifié avec succès.');
    }


    public function destroy(BlogPost $post)
    {
        $post->delete();

        return redirect()->back()->with('success', 'L’article a été supprimé avec succès.');
    }
}
