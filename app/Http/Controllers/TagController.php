<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class TagController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('manageuser', User::class);
        $tags = Tag::all();
        return view('dashboard.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('manageuser', User::class);
        return view('dashboard.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('manageUser', User::class);
        $request->validate([
            'tag' => 'required|string|min:3|max:60',
        ]);

        Tag::create([
            'name' => $request->tag,
        ]);
        return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        $this->authorize('manageuser', User::class);
        return view('dashboard.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $this->authorize('manageuser', User::class);
        $request->validate([
            'tag' => 'required|string|min:3|max:60',
        ]);

        $tag->update([
            'name' => $request->tag,
        ]);
        return redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $this->authorize('manageuser', User::class);
        $tag->delete();
        return redirect()->route('tags.index');
    }
}
