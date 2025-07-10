<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumPostController extends Controller
{
    public function index()
    {
        $posts = ForumPost::with('user')->latest()->paginate(15);
        return view('forum.index', compact('posts'));
    }

    public function create()
    {
        return view('forum.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = ForumPost::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('forum.show', $post);
    }

    public function show(ForumPost $forum)
    {
        // Eager load comments and their users
        $forum->load('comments.user');
        return view('forum.show', ['post' => $forum]);
    }

    public function destroy(ForumPost $forumPost)
    {
        $this->authorize('delete', $forumPost);

        $forumPost->delete();

        return redirect()->route('forum.index')->with('success', 'Postingan forum berhasil dihapus.');
    }
}
