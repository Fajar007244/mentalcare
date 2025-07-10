<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use App\Models\ForumComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumCommentController extends Controller
{
    public function store(Request $request, ForumPost $forum)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $forum->comments()->create([
            'content' => $request->content,
            'user_id' => Auth::id(),
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    public function destroy(ForumComment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return back()->with('success', 'Komentar berhasil dihapus.');
    }
}
