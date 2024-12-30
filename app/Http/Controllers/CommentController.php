<?php

namespace App\Http\Controllers;

use App\Models\comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string',
            'post_id' => 'required|numeric'
        ]);

        Comment::create([
            'comment' => $request->comment,
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('posts.show', $request->post_id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(comment $comment)
    {
        if ($comment->user_id == Auth::id()) {
            return view('comments.edit', compact('comment'));
        }
        return redirect()->route('posts.show', $comment->post_id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, comment $comment)
    {
        if ($comment->user_id == Auth::id()) {
            $request->validate([
                'comment' => 'required|string',
            ]);

            $comment->update([
                'comment' => $request->comment,
                'post_id' => $comment->post_id,
                'user_id' => Auth::id(),
            ]);
        }
        return redirect()->route('posts.show', $comment->post_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(comment $comment)
    {
        if ($comment->user_id == Auth::id() || $comment->post->user_id == Auth::id()) {
            $comment->delete();
        }
        return redirect()->route('posts.show', $comment->post_id);
    }
}
