<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view("posts.create", compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'category' => 'numeric|nullable',
            'tags' => 'array',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('assets/images/posts'), $imageName);
        }

        $post = Post::create([
            "user_id" => Auth::id(),
            "title" => $request->title,
            "description" => $request->description,
            "category_id" => $request->category,
            "image" => isset($imageName) ? $imageName : NULL,
        ]);
        $post->tags()->attach($request->tags);
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $user = $post->user;
        $category = $post->category ? $post->category->name : null;
        $tags = $post->tags->pluck('name');
        $comments = $post->comments()->with('user')->get();
        return view('posts.show', compact('post', 'user', 'category', 'tags', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if ($post->user_id == Auth::id()) {
            $categories = Category::all();
            $tags = Tag::all();
            $postTags = $post->tags->pluck('id');
            return view("posts.edit", compact('categories', 'tags', 'post', 'postTags'));
        }
        return redirect()->route('posts.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'category' => 'numeric|nullable',
            'tags' => 'array',
        ]);

        if ($request->hasFile('image')) {
            if ($post->image) {
                if (file_exists(public_path('assets/images/posts/' . $post->image))) {
                    unlink(public_path('assets/images/posts/' . $post->image));
                }
            }
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('assets/images/posts'), $imageName);
            $post->image = $imageName;
        }

        $post->update([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category,
            'image' => $post->image,
        ]);

        $post->tags()->sync($request->tags);
        return redirect()->route('posts.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->user_id == Auth::id()) {
            if ($post->image) {
                if (file_exists(public_path('assets/images/posts/' . $post->image))) {
                    unlink(public_path('assets/images/posts/' . $post->image));
                }
            }
            $post->delete();
            return redirect()->route('posts.index');
        }
    }
}
