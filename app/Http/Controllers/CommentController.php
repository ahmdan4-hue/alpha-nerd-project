<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $data = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Comment::create([
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'content' => $data['content'],
        ]);

        return back()->with('success', 'Comment added ✅');
    }

    public function destroy(Comment $comment)
    {
        $user = Auth::user();

        // allow delete if admin OR owner of comment
        if (!$user->is_admin && $comment->user_id !== $user->id) {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', 'Comment deleted ✅');
    }
}
